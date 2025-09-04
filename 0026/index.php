<?php
session_start();
require_once 'config.php';

$isLoggedIn = isset ($_SESSION['user_id']);
$stmt = $conn->query("SELECT p.*, c.category_name  
    FROM products p  
    LEFT JOIN categories c ON p.category_id = c.category_id  
    ORDER BY p.created_at DESC"); 
$products = $stmt->fetchAll(PDO::FETCH_ASSOC); 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> หน้าหลัก </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 50%, #90caf9 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .main-container {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .welcome-header {
        background: linear-gradient(45deg, #2196f3, #1976d2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .user-info-card {
        background: linear-gradient(45deg, #e3f2fd, #f0f8ff);
        border: 2px solid #2196f3;
        border-radius: 15px;
        transition: transform 0.3s ease;
        }
        
        .user-info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(33, 150, 243, 0.3);
        }
        
        .btn-custom-logout {
        background: linear-gradient(45deg, #1976d2, #1565c0);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(25, 118, 210, 0.3);
        }
        
        .btn-custom-logout:hover {
        background: linear-gradient(45deg, #1565c0, #0d47a1);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(25, 118, 210, 0.4);
        color: white;
        }
        
        .icon-decoration {
        background: linear-gradient(45deg, #2196f3, #03a9f4);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        box-shadow: 0 8px 25px rgba(33, 150, 243, 0.3);
        }
        
        .floating-elements::before {
        content: '';
        position: absolute;
        top: 10%;
        left: 10%;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(33, 150, 243, 0.1), transparent);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
        }
        
        .floating-elements::after {
        content: '';
        position: absolute;
        bottom: 10%;
        right: 10%;
        width: 150px;
        height: 150px;
        background: radial-gradient(circle, rgba(3, 169, 244, 0.1), transparent);
        border-radius: 50%;
        animation: float 8s ease-in-out infinite reverse;
        }
        
        @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        }
        
        .role-badge {
        background: linear-gradient(45deg, #00bcd4, #0097a7);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.9em;
        font-weight: 500;
        display: inline-block;
        box-shadow: 0 3px 10px rgba(0, 188, 212, 0.3);
        }
    </style>
</head>
<body class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="welcome-header"> รายการสินค้า </h1>
<div>
    <?php
        if ($isLoggedIn):?>
        <span class="me-3">ยินดีต้อนรับ, <?= htmlspecialchars($_SESSION['username']) ?> (<?= 
        $_SESSION['role'] ?>)</span> 
        <a href="profile.php" class="btn btn-info"> ข้อมูลส่วนตัว </a> 
        <a href="cart.php" class="btn btn-warning"> ดูตะกร้า </a> 
        <a href="logout.php" class="btn btn-secondary"> ออกจากระบบ </a> 
    <?php else: ?> 
        <a href="login.php" class="btn btn-success"> เข้าสู่ระบบ </a> 
        <a href="register.php" class="btn btn-primary"> สมัครสมาชิก </a> 
    <?php endif; ?>
</div>

</div>
<!-- รายการสินค้าที่ต้องการแสดง -->
<div class="row"> 
    <?php foreach ($products as $product): ?> 
        <div class="col-md-4 mb-4"> 
            <div class="card h-100"> 
                <div class="card-body"> 
    <h5 class="card-title"><?= htmlspecialchars(string: $product['product_name']) ?></h5> 
    <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($product['category_name']) ?>
    <p class="card-text"><?= nl2br(htmlspecialchars($product['description'])) ?></p> 
        <p><strong>ราคา:</strong> <?= number_format($product['price'], 2) ?> บาท </p> 
        <?php if ($isLoggedIn): ?> 
            <form action="cart.php" method="post" class="d-inline"> 
                <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>"> 
                <input type="hidden" name="quantity" value="1"> 
                <button type="submit" class="btn btn-sm btn-success"> เพิ่มในตะกร้า </button> 
            </form> 
        <?php else: ?> 
                <small class="text-muted"> เข้าสู่ระบบเพื่อสั่งซื้อ </small> 
        <?php endif; ?> 
                <a href="product_detail.php?id=<?= $product['product_id'] ?>" class="btn btn-sm btn-outline-primary float-end"> ดูรายละเอียด </a>
                </div> 
                </div> 
            </div> 
        <?php endforeach; ?> 
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
