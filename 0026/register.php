<?php
    require_once 'config.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // รับค่าจากฟอร์ม
        $username = trim($_POST['username']);
        $fullname = trim($_POST['fullname']);
        $email = trim($_POST['email']);
        $password = ($_POST['password']);
        $confirm_password = ($_POST['confirm_password']);

    // นำข้อมูลไปบันทึกในฐานข้อมูล

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(username,full_name,email,password,role) VALUES (?, ?, ?, ?, 'admin')";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username,$fullname,$email,$hashedPassword]);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> register </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container mt-5">
        <h2> สมัครสมาชิก </h2>
        <form action="register.php" method="post">
        <div>
            <label for="username" class="form-label"> ชื่อผู้ใช้ </label>
            <input type="text" name="username" id="username" class="form-control" placeholder="ชื่อผู้ใช้" required>
        </div>
        
    <div>
        <label for="fullname" class="form-label"> ชื่อ - นามสกุล </label>
            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="ชื่อ - นามสกุล" required>
        </div>

        <div>
            <label for="email" class="form-label"> อีเมล </label>
            <input type="text" name="email" id="email" class="form-control" placeholder="อีเมล" required>
        </div>

        <div>
            <label for="password" class="form-label"> รหัสผ่าน </label>
            <input type="text" name="password" id="password" class="form-control" placeholder="รหัสผ่าน" required>
        </div>

        <div>
            <label for="confirm_password" class="form-label"> ยืนยันรหัสผ่าน </label>
            <input type="text" name="confirm_password" id="confirm_password" class="form-control" placeholder="ยืนยันรหัสผ่าน" required>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">สมัครสมาชิก</button>
            <a href="login.php" class="btn btn-link">เข้าสู่ระบบ</a>
        </div>

</form>
</div>
    <script scr="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>