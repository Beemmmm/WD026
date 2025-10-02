<?php
require_once 'config.php';

$error = []; //Arror to hold

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // รับค่าจากฟอร์ม
    $std_id = trim($_POST['std_id']);
    $f_name = trim($_POST['f_name']);
    $L_name = ($_POST['L_name']);
    $mail = ($_POST['mail']);
    $tel = ($_POST['tel']);
    $address = ($_POST['address']);

    // ตรวจสอบว่ากรอกข้อมูลครบหรือไม่ (empty)
    if (empty($std_id) || empty($f_name) || empty($L_name) || empty($mail) || empty($tel) || empty($address)) {
        $error[] = "กรุณากรอกข้อมูลให้ครบทุกช่อง";


        // ตรวจสอบงาสอีเมลถูกต้องหรือไม่ (filter_var)
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // ตรวจสอบรูปแบบอีเมล
        $reeor[] = "กรุณากรอกอีเมลให้ถูกต้อง";

    if (empty($error)) {
        // นำข้อมูลไปบันทึกในฐานข้อมูล
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO td_664230026(std_id,f_name,L_name,mail,tel,address) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$std_id, $f_name, $L_name, $mail, $tel, $address]);

        // ถ้าบันทึกสำเร็จ ใฟ้เปลี่ยนเส้นทางไปหน้า iogin
        header("Location: index.php?register=success");
        exit(); // หยุดการทำงานของสคริปต์หลังจากเปลี่ยนเส้นทาง
        }
    }
}
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> เพิ่มนักศึกษา </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <style>
     

        .register-container {
            max-width: 500px;
            /* จำกัดความกว้างของฟอร์ม */
            margin: 50px auto;
            /* จัดฟอร์มให้อยู่ตรงกลางหน้าจอ */
            padding: 30px;
            background-color: #bad6e2ff;
            border-radius: 8px;
            /* เพิ่มมุมโค้งมน */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* เพิ่มเงาให้ดูมีมิติ */
        }
    </style>
</head>

<body>

    <div class="container register-container">
        <h2 class="text-center mb-4"> เพิ่มนักศึกษา </h2>
        <?php if (!empty($error)): // ถ้ามีข้อผิดพลำด ให้แสดงข้อความ ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($error as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                        <!-- ใช ้ htmlspecialchars เพื่อป้องกัน XSS -->
                        <!-- < ? = คือ short echo tag ?> -->
                        <!-- ถ้าเขียนเต็ม จะได้แบบด้านล่ำง -->
                        <?php // echo "<li>" . htmlspecialchars($e) . "</li>"; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="index.php" method="post">
            <div class="mb-3">
                <label for="std_id" class="form-label"> รหัสนักศึกษา </label>
                <input type="text" name="std_id" id="std_id" class="form-control" placeholder="เช่น 664230026"
                    value="<?= isset($_POST['std_id']) ? htmlspecialchars($_POST['std_id']) : '' ?>" required>
            </div>

            <div class="mb-3">
                <label for="f_name" class="form-label"> ชื่อ </label>
                <input type="text" name="f_name" id="f_name" class="form-control" placeholder="ชื่อ"
                    value="<?= isset($_POST['f_name']) ? htmlspecialchars($_POST['f_name']) : '' ?>" required>
            </div>

            <div class="mb-3">
                <label for="L_name" class="form-label"> สกุล </label>
                <input type="text" name="L_name" id="L_name" class="form-control" placeholder="นามสกุล"
                    value="<?= isset($_POST['L_name']) ? htmlspecialchars($_POST['L_name']) : '' ?>" required>
            </div>

             <div class="mb-3">
                <label for="mail" class="form-label"> อีเมล </label>
                <input type="text" name="mail" id="mail" class="form-control" placeholder="@mail.com"
                    value="<?= isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : '' ?>" required>
            </div>

            <div class="mb-3">
                <label for="tel" class="form-label"> เบอร์โทร </label>
                <input type="text" name="tel" id="tel" class="form-control" placeholder="08XXXXXXX"
                    value="<?= isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : '' ?>" required>
            </div>

           <div class="mb-3">
                <label for="address" class="form-label"> ที่อยู่ </label>
                <input type="text" name="address" id="address" class="form-control" placeholder="ที่อยู่ปัจจุบัน"
                    value="<?= isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '' ?>" required>
            </div>
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-info "> ดูรายการ </button>
            </div>
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-info "> เพิ่มข้อมูล</button>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>