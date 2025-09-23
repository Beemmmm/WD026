<?php

require_once 'config.php'; //เชื่อมต่อฐานข้อมูล
session_start();

$isLoggedIn = isset($_SESSION['user_id']);

if(!isset($_GET['id'])){
    header('Location: index.php');
    exit();
}

$product_id = $_GET['id']; 

$stmt = $conn->prepare("SELECT p.*, c.category_name  
    FROM products p  
    LEFT JOIN categories c ON p.category_id = c.category_id  
    WHERE p.product_id = ?"); 
$stmt->execute([$product_id]);
$product = $stmt->fetch(PDO::FETCH_ASSOC); 


$img = !empty($product['image'])
? 'product_images/' . rawurlencode($product['image'])
: 'product_images/no-image.jpeg';

?>

<!DOCTYPE html> 
<html lang="th"> 
<head> 
    <meta charset="UTF-8"> 
    <title>รายละเอียดสินค้า</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #293557ff; /* เพิ่มสีพื้นหลังเหมือนฟอร์มสมัครสมาชิก */
        }
        
        .main-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: #bad6e2ff;
            border-radius: 8px; /* เพิ่มมุมโค้งมน */
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* เพิ่มเงาให้ดูมีมิติ */
        }
        
        .card {
            background-color: #dde6ebff;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
    </style>
</head> 
<body>
    <div class="container main-container">

        <a href="index.php" class="btn btn-secondary mb-3">← กลับหน้ารายการสินค้า</a>

        <div class="card"> 

        <img src="<?= $img ?>">

            <div class="card-body"> 
                <h3 class="card-title"><?= htmlspecialchars($product['product_name'])?></h3> 
                <h6 class="text-muted">หมวดหมู่: <?= htmlspecialchars($product['category_name'])?></h6> 
                <p class="card-text mt-3"><?= nl2br(htmlspecialchars($product['description']))?></p> 
                <p><strong>ราคา:</strong> <?= number_format($product['price'], 2)?> บาท</p> 
                <p><strong>คงเหลือ:</strong> <?= htmlspecialchars($product['stock'])?> ชิ้น</p> 

                <?php if ($isLoggedIn): ?> 
                    <form action="cart.php" method="post" class="mt-3"> 
                        <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>"> 
                        <div class="mb-3">
                            <label for="quantity" class="form-label">จำนวน:</label> 
                            <input type="number" name="quantity" id="quantity" class="form-control" style="width: 100px; display: inline-block;" value="1" min="1" max="<?= $product['stock'] ?>" required> 
                        </div>
                        <button type="submit" class="btn btn-info">เพิ่มในตะกร้า</button>
                    </form> 
                <?php else: ?> 
                    <div class="alert alert-info mt-3">กรุณาเข้าสู่ระบบเพื่อสั่งสินค้า</div>
                <?php endif; ?> 
            </div> 
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body> 
</html>