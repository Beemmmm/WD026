<?php 
session_start(); 
require_once '../config.php';
require_once 'auth_admin.php';

// ตรวจสอบสิทธิ admin 
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') { 
    header("Location: ../login.php"); 
    exit; 
} 
?> 

<!DOCTYPE html> 
<html lang="th"> 
<head> 
    <meta charset="UTF-8"> 
    <title>แผงควบคุมผู้ดูแลระบบ</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #293557ff; /* เพิ่มสีพื้นหลังเหมือนฟอร์มสมัครสมาชิก */
        }
        
        .main-container {
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background-color: #bad6e2ff;
            border-radius: 8px; /* เพิ่มมุมโค้งมน */
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* เพิ่มเงาให้ดูมีมิติ */
        }
    </style>
</head> 
<body>
    <div class="container main-container">

        <h2 class="text-center mb-4">ระบบผู้ดูแลระบบ</h2>
        <hr>
        <p class="text-center mb-4">ยินดีต้อนรับ, <?= htmlspecialchars($_SESSION['username']) ?></p> 

        <div class="row"> 
            <div class="col-md-4 mb-3"> 
                <a href="users.php" class="btn btn-warning w-100">จัดการสมาชิก</a> 
            </div> 
            <div class="col-md-4 mb-3"> 
                <a href="categories.php" class="btn btn-dark w-100">จัดการหมวดหมู่</a> 
            </div>
            <div class="col-md-4 mb-3"> 
                <a href="products.php" class="btn btn-primary w-100">จัดการสินค้า</a> 
            </div> 
            <div class="col-md-4 mb-3"> 
                <a href="orders.php" class="btn btn-success w-100">จัดการคำสั่งซื้อ</a> 
            </div> 
        </div> 

        <div class="text-center mt-4">
            <a href="../logout.php" class="btn btn-secondary">ออกจากระบบ</a> 
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body> 
</html>