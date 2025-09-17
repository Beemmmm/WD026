<?php

require '../config.php';
require_once 'auth_admin.php';

// เพิ่มหมวดหมู่
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
    $category_name = trim($_POST['category_name']);
    if ($category_name) {
        $stmt = $conn->prepare("INSERT INTO categories (category_name) VALUES (?)");
        $stmt->execute([$category_name]);
        header("Location: category.php");
        exit;
    }
}

// ลบหมวดหมู่
// ตรวจสอบว่าหมวดหมู่นี้ยังถูกใช้หรือไม่
if (isset($_GET['delete'])) {
    $category_id = $_GET['delete'];
    // ตรวจสอบว่าหมวดหมู่นี้ยังมีสินค้าอยู่หรือไม่
    $stmt = $conn->prepare("SELECT COUNT(*) FROM products WHERE category_id = ?");
    $stmt->execute([$category_id]);
    $productCount = $stmt->fetchColumn();
    if ($productCount > 0) {
        // ถ้ามีสินค้าอยู่ในหมวดหมู่นี้
        $_SESSION['error'] = "ไม่สามารถลบหมวดหมู่ได้ เนื่องจากยังมีสินค้าที่ใช้งานในหมวดหมู่นี้อยู่";
    } else {
        // ถ้าไม่มีสินค้า ให้ลบได้
        $stmt = $conn->prepare("DELETE FROM categories WHERE category_id = ?");
        $stmt->execute([$category_id]);
        $_SESSION['success'] = "ลบหมวดหมู่เรียบร้อยแล้ว";
    }
    header("Location: category.php");
    exit;
}

// แก้ไขหมวดหมู่
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_category'])) {
    $category_id = $_POST['category_id'];
    $category_name = trim($_POST['new_name']);
    if ($category_name) {
        $stmt = $conn->prepare("UPDATE categories SET category_name = ? WHERE category_id = ?");
        $stmt->execute([$category_name, $category_id]);
        header("Location: category.php");
        exit;
    }
}


// ดึงหมวดหมู่ทั้งหมด
$categories = $conn->query("SELECT * FROM categories ORDER BY category_id ASC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการหมวดหมู่</title>
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
        .form-control, .form-select {
            background-color: #d8e5ec;
            border: 1px solid #bad6e2ff;
        }
        .alert {
            border-radius: 8px;
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
    </style>
</head>
<body>
    <div class="container main-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>จัดการหมวดหมู่สินค้า</h2>
            <a href="index.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> กลับหน้าผู้ดูแล
            </a>
        </div>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- ฟอร์มเพิ่มหมวดหมู่ -->
        <div class="card p-4 mb-4">
            <h5>เพิ่มหมวดหมู่ใหม่</h5>
            <form method="post" class="row g-3">
                <div class="col-md-6">
                    <label for="category_name" class="form-label">ชื่อหมวดหมู่ใหม่</label>
                    <input type="text" name="category_name" id="category_name" class="form-control" placeholder="ชื่อหมวดหมู่ใหม่" required>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" name="add_category" class="btn btn-primary w-100">
                        <i class="bi bi-plus-circle"></i> เพิ่ม
                    </button>
                </div>
            </form>
        </div>

        <!-- รายการหมวดหมู่ -->
        <h5>รายการหมวดหมู่</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ชื่อหมวดหมู่</th>
                        <th>แก้ไขชื่อ</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td><?= htmlspecialchars($cat['category_name']) ?></td>
                            <td>
                                <form method="post" class="d-flex">
                                    <input type="hidden" name="category_id" value="<?= $cat['category_id'] ?>">
                                    <input type="text" name="new_name" class="form-control me-2" placeholder="ชื่อใหม่" required>
                                    <button type="submit" name="update_category" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i> แก้ไข
                                    </button>
                                </form>
                            </td>
                            <td>
                                <a href="category.php?delete=<?= $cat['category_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('คุณต้องการลบหมวดหมู่นี้หรือไม่?')">
                                    <i class="bi bi-trash"></i> ลบ
                                </a>
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
