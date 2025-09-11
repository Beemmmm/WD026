<?php 

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
            background-color: #293557ff;
        }
        
        .main-container {
            max-width: 900px;
            margin: 50px auto;
            padding: 30px;
            background-color: #bad6e2ff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        /* CSS สำหรับจัดเรียงปุ่มแบบ 2 แถวที่ยาวขึ้นและไม่มีกรอบ */
        .button-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            justify-items: center;
            align-items: center;
            padding: 15px 0;
        }
        
        .button-grid .btn {
            width: 100%;
            max-width: 300px; 
            height: 70px;
            font-size: 1.1rem;
            font-weight: bold;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2); 
            transition: all 0.2s ease-in-out;
            border: none;
        }

        .button-grid .btn:hover {
            transform: translateY(-4px); 
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
        }

        /* ปรับปรุง CSS สำหรับปุ่ม "ออกจากระบบ" */
        .logout-container {
            /* เปลี่ยน text-align เป็นการใช้ flexbox สำหรับการจัดให้อยู่กึ่งกลาง */
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        
        .logout-btn {
            width: 100%;
            max-width: 300px; 
            height: 70px; 
            font-weight: bold;
            font-size: 1.1rem;
            transition: all 0.2s ease-in-out;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2); 
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
        }

        .logout-btn:hover {
            transform: translateY(-4px); 
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.3);
        }

        /* สำหรับหน้าจอขนาดเล็ก ให้ปุ่มเรียงกันเป็น 1 คอลัมน์ */
        @media (max-width: 768px) {
            .button-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head> 
<body>
    <div class="container main-container">

        <h2 class="text-center mb-4">ระบบผู้ดูแลระบบ</h2>
        <hr>
        <p class="text-center mb-4">ยินดีต้อนรับ, <?= htmlspecialchars($_SESSION['username']) ?></p> 

        <div class="button-grid"> 
            <a href="users.php" class="btn btn-warning">จัดการสมาชิก</a> 
            <a href="category.php" class="btn btn-dark">จัดการหมวดหมู่</a> 
            <a href="products.php" class="btn btn-primary">จัดการสินค้า</a> 
            <a href="orders.php" class="btn btn-success">จัดการคำสั่งซื้อ</a> 
        </div> 

        <div class="logout-container">
            <a href="../logout.php" class="btn btn-secondary logout-btn">ออกจากระบบ</a> 
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body> 
</html>