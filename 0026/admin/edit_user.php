<?php

require '../config.php'; // เชื่อมต่อฐานข้อมูลด้วย PDO
// การกำหนดสิทธิ์ (Admin Guard)
require_once 'auth_admin.php';

// ตรวจสอบว่ามีพารามิเตอร์ id มาจริงไหม (ผ่าน GET)
if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit;
}
// ดึงค่า id และ "แคสต์เป็น int" เพื่อความปลอดภัย
$user_id = (int)$_GET['id'];
// ดึงข้อมูลสมาชิกที่จะถูกแก้ไข
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id = ? AND role = 'member'");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
// ถ้าไม่พบข้อมูล -> แสดงข้อความและ exit
if (!$user) {
    echo "<h3>ไม่พบสมาชิก</h3>";
    exit;
}
// ========== เมื่อผู้ใช้กด Submit ฟอร์ม ==========
$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่า POST + trim
    $username = trim($_POST['username']);
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);

    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    // ตรวจความครบถ้วน และตรวจรูปแบบ email
    if ($username === '' || $email === '') {
        $error = "กรุณากรอกข้อมูลให้ครบถ้วน";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "รูปแบบอีเมลไม่ถูกต้อง";
    }

    // ถ้า validate ผ่านให้ตรวจสอบซ้ำ (username/email ชนกับคนอื่นที่ไม่ใช่ของตนเองหรือไม่)
    if (!$error) {
        $chk = $conn->prepare("SELECT 1 FROM users WHERE (username = ? OR email = ?) AND user_id != ?");
        $chk->execute([$username, $email, $user_id]);
        if ($chk->fetch()) {
            $error = "ชื่อผู้ใช้หรืออีเมลนี้มีอยู่แล้วในระบบ";
        }
    }


    // ตรวจรหัสผ่าน (กรณีต้องการเปลี่ยน)
    // เงื่อนไข: อนุญาตให้ปล่อยว่างได้ (คือไม่เปลี่ยนรหัสผ่าน)
    $updatePassword = false;
    $hashed = null;
    if (!$error && ($password !== '' || $confirm !== '')) {
        // นศ.เตมิกติกา เช่น ยาว >= 6 และรหัสผ่านตรงกัน
        if (strlen($password) < 6) {
            $error = "รหัสผ่านต้องยาวอย่างน้อย 6 อักขระ";
        } elseif ($password !== $confirm) {
            $error = "รหัสผ่านใหม่กับยืนยันรหัสผ่านไม่ตรงกัน";
        } else {
            // แฮชรหัสผ่าน
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $updatePassword = true;
        }
    }
    // สร้าง SQL UPDATE แบบยืดหยุ่น (ถ้าไม่เปลี่ยนรหัสผ่านจะไม่แตะ field password)
    if (!$error) {
        if ($updatePassword) {
            // อัปเดตรวมรหัสผ่าน
            $sql = "UPDATE users
                    SET username = ?, full_name = ?, email = ?, password = ?
                    WHERE user_id = ?";
            $args = [$username, $full_name, $email, $hashed, $user_id];
        } else {
            // อัปเดตเฉพาะข้อมูลทั่วไป
            $sql = "UPDATE users
                    SET username = ?, full_name = ?, email = ?
                    WHERE user_id = ?";
            $args = [$username, $full_name, $email, $user_id];
        }
        $upd = $conn->prepare($sql);
        $upd->execute($args);
        header("Location: users.php");
        exit;
    }
    
    // OPTIONAL: อัปเดตค่า $user เพื่อสะท้อนค่าที่ช่องฟอร์ม (หากมี error)
    $user['username'] = $username;
    $user['full_name'] = $full_name;
    $user['email'] = $email;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขสมาชิก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #293557ff;
        }
        .main-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
            background-color: #bad6e2ff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        h2 {
            color: #293557ff;
        }
        .form-label, .text-muted {
            color: #293557ff;
        }
        .form-control, .form-select {
            background-color: #d8e5ec;
            border: 1px solid #bad6e2ff;
        }
        .alert {
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="container main-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>แก้ไขข้อมูลสมาชิก</h2>
            <a href="users.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> กลับหน้ารายชื่อสมาชิก
            </a>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" class="row g-3">
            <div class="col-md-6">
                <label for="username" class="form-label">ชื่อผู้ใช้</label>
                <input type="text" name="username" id="username" class="form-control" required value="<?= htmlspecialchars($user['username']) ?>">
            </div>
            <div class="col-md-6">
                <label for="full_name" class="form-label">ชื่อ - นามสกุล</label>
                <input type="text" name="full_name" id="full_name" class="form-control" value="<?= htmlspecialchars($user['full_name']) ?>">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">อีเมล</label>
                <input type="email" name="email" id="email" class="form-control" required value="<?= htmlspecialchars($user['email']) ?>">
            </div>
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
            </div>
            
            <hr class="mt-4">

            <div class="col-md-6">
                <label for="password" class="form-label">รหัสผ่านใหม่ <small class="text-muted">(ถ้าไม่ต้องการเปลี่ยนให้เว้นว่าง)</small></label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="col-md-6">
                <label for="confirm_password" class="form-label">ยืนยันรหัสผ่านใหม่</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control">
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
