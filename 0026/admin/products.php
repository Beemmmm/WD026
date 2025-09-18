<?php
require_once '../config.php';
require_once 'auth_admin.php'; 

// เพิ่มสินค้าใหม่
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
$name = trim($_POST['product_name']);
$description = trim($_POST['description']);
$price = floatval($_POST['price']); // floatval() ใช้แปลงเป็น float
$stock = intval($_POST['stock']); // intval() ใช้แปลงเป็น integer
$category_id = intval($_POST['category_id']);
// ค่าที่ได้จากฟอร์มเป็น string เสมอ
if ($name && $price > 0) {
    
    $imageName = null;
if (!empty($_FILES['product_image']['name'])) {
$file = $_FILES['product_image'];
$allowed = ['image/jpeg', 'image/png'];

if (in_array($file['type'], $allowed)) {
$ext = pathinfo($file['name'], PATHINFO_EXTENSION);
$imageName = 'product_' . time() . '.' . $ext;
$path = __DIR__ . '/../product_images/' . $imageName;
move_uploaded_file($file['tmp_name'], $path);
    }
}
$stmt = $conn->prepare("INSERT INTO products (product_name, description, price, stock, category_id, image)
VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([$name, $description, $price, $stock, $category_id, $imageName]);




    // ตรวจสอบชื่อ และราคา
// $stmt = $conn->prepare("INSERT INTO products (product_name, description, price, stock, category_id) VALUES (?, ?, ?, ?, ?)");
// $stmt->execute([$name, $description, $price, $stock, $category_id]);
header("Location: products.php");
exit;
}
}

// ลบสินค้า
// if (isset($_GET['delete'])) {

// $product_id = $_GET['delete'];
// $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
// $stmt->execute([$product_id]);
// header("Location: products.php");
// exit;
// }

// ลบสนิ คำ้ (ลบไฟลร์ปู ดว้ย)
if (isset($_GET['delete'])) {
$product_id = (int)$_GET['delete']; // แคสต์เป็น int
// 1) ดงึชอื่ ไฟลร์ปู จำก DB ก่อน
$stmt = $conn->prepare("SELECT image FROM products WHERE product_id = ?");
$stmt->execute([$product_id]);
$imageName = $stmt->fetchColumn(); // null ถ ้ำไม่มีรูป
// 2) ลบใน DB ด ้วย Transaction
try {
$conn->beginTransaction();
$del = $conn->prepare("DELETE FROM products WHERE product_id = ?");
$del->execute([$product_id]);
$conn->commit();
} catch (Exception $e) {
$conn->rollBack();
// ใส่ flash message หรือ log ได ้ตำมต ้องกำร
header("Location: products.php");
exit;
}
// 3) ลบไฟล์รูปหลัง DB ลบส ำเร็จ
if ($imageName) {
$baseDir = realpath(__DIR__ . '/../product_images'); // โฟลเดอร์เก็บรูป
$filePath = realpath($baseDir . '/' . $imageName);
// กัน path traversal: ต ้องอยู่ใต้ $baseDir จริง ๆ
if ($filePath && strpos($filePath, $baseDir) === 0 && is_file($filePath)) {
@unlink($filePath); // ใช ้@ กัน warning ถำ้ลบไมส่ ำเร็จ
}
}
header("Location: products.php");
exit;
}


// ดึงรายการสินค้า
$stmt = $conn->query("SELECT p.*, c.category_name FROM products p LEFT JOIN categories c ON p.category_id = c.category_id ORDER BY p.created_at DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// ดึงหมวดหมู่
$categories = $conn->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>จัดการสินค้า</title>
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
h2, h5 {
color: #293557ff;
}
.card {
background-color: #bad6e2ff;
border: none;
border-radius: 8px;
box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}
.table thead th {
background-color: #bad6e2ff;
}
.table th, .table td {
vertical-align: middle;
}
.table tbody tr:hover {
background-color: #d8e5ec;
}
.form-control, .form-select {
background-color: #d8e5ec;
border: 1px solid #bad6e2ff;
}
</style>
</head>
<body>
<div class="container main-container">
<div class="d-flex justify-content-between align-items-center mb-4">
<h2>จัดการสินค้า</h2>
<a href="index.php" class="btn btn-secondary">
<i class="bi bi-arrow-left"></i> กลับหน้าผู้ดูแล
</a>
</div>

<!-- ฟอร์มเพิ่มสินค้าใหม่ -->
<div class="card p-4 mb-4">
<h5>เพิ่มสินค้าใหม่</h5>
<form method="post" enctype="multipart/form-data" class="row g-3">
<div class="col-md-3">
<label for="product_name" class="form-label">ชื่อสินค้า</label>
<input type="text" name="product_name" id="product_name" class="form-control" placeholder="ชื่อสินค้า" required>
</div>
<div class="col-md-3">
<label for="category_id" class="form-label">หมวดหมู่</label>
<select name="category_id" id="category_id" class="form-select" required>
<option value="">เลือกหมวดหมู่</option>
<?php foreach ($categories as $cat): ?>
<option value="<?= $cat['category_id'] ?>"><?= htmlspecialchars($cat['category_name']) ?></option>
<?php endforeach; ?>
</select>
</div>
<div class="col-md-3">
<label for="price" class="form-label">ราคา</label>
<input type="number" step="0.01" name="price" id="price" class="form-control" placeholder="ราคา" required>
</div>
<div class="col-md-3">
<label for="stock" class="form-label">จำนวนคงเหลือ</label>
<input type="number" name="stock" id="stock" class="form-control" placeholder="จำนวน" required>
</div>
<div class="col-12">
<label for="description" class="form-label">รายละเอียดสินค้า</label>
<textarea name="description" id="description" class="form-control" placeholder="รายละเอียดสินค้า" rows="3"></textarea>
</div>
<div class="col-md-4">
<label class="form-label">รูปสินค้า(jpg, png)</label>
<input type="file" name="product_image" class="form-control">
</div>
<div class="col-12 mt-3">
<button type="submit" name="add_product" class="btn btn-primary">เพิ่มสินค้า</button>
</div>
</form>
</div>

<!-- แสดงรายการสินค้า, แก้ไข, ลบ -->
<h5 class="mb-3">รายการสินค้า</h5>
<div class="table-responsive">
<table class="table table-bordered table-hover">
<thead>
<tr>
<th>ชื่อสินค้า</th>
<th>หมวดหมู่</th>
<th>ราคา</th>
<th>คงเหลือ</th>
<th>จัดการ</th>
</tr>
</thead>
<tbody>
<?php foreach ($products as $p): ?>
<tr>
<td><?= htmlspecialchars($p['product_name']) ?></td>
<td><?= htmlspecialchars($p['category_name']) ?></td>
<td><?= number_format($p['price'], 2) ?> บาท</td>
<td><?= $p['stock'] ?></td>
<td>
<a href="edit_products.php?id=<?= $p['product_id'] ?>" class="btn btn-sm btn-warning me-2"><i class="bi bi-pencil-square"></i> แก้ไข</a>
<a href="products.php?delete=<?= $p['product_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('ยืนยันการลบสินค้านี้')"><i class="bi bi-trash"></i> ลบ</a>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>