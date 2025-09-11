<?php 

require_once '../config.php'; 
require_once 'auth_admin.php';

// ลบสมาชิก 
if (isset($_GET['delete'])) { 
    $user_id = $_GET['delete']; 
    // ป้องกันลบตัวเอง 
    if ($user_id != $_SESSION['user_id']) { 
        $stmt = $conn->prepare("DELETE FROM users WHERE user_id = ? AND role = 'member'"); 
        $stmt->execute([$user_id]); 
    } 
    header("Location: users.php"); 
    exit; 
} 

// ดึงข้อมูลสมาชิก 
$stmt = $conn->prepare("SELECT * FROM users WHERE role = 'member' ORDER BY created_at DESC"); 
$stmt->execute(); 
$users = $stmt->fetchAll(PDO::FETCH_ASSOC); 
?> 

<!DOCTYPE html> 
<html lang="th"> 
<head> 
    <meta charset="UTF-8"> 
    <title>จัดการสมาชิก</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- DataTable CSS -->
    <link href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css" rel="stylesheet">
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #293557ff; /* เพิ่มสีพื้นหลังเหมือนฟอร์มสมัครสมาชิก */
        }
        
        .main-container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
            background-color: #bad6e2ff;
            border-radius: 8px; /* เพิ่มมุมโค้งมน */
            box-shadow: 0 4px 6px rgba(0,0,0,0.1); /* เพิ่มเงาให้ดูมีมิติ */
        }
        
        .table {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }
    </style>
</head> 
<body>
    <div class="container main-container">

        <h2 class="text-center mb-4">จัดการสมาชิก</h2>
        <hr>
        <a href="index.php" class="btn btn-secondary mb-3">← กลับหน้าผู้ดูแล</a> 

        <?php if (count($users) === 0): ?> 
            <div class="alert alert-warning">ยังไม่มีสมาชิกในระบบ</div>
        <?php else: ?> 
            <table id="productTable" class="table table-striped table-bordered">
                <thead> 
                    <tr> 
                        <th>ชื่อผู้ใช้</th> 
                        <th>ชื่อ-นามสกุล</th> 
                        <th>อีเมล</th> 
                        <th>วันที่สมัคร</th> 
                        <th>จัดการ</th> 
                    </tr> 
                </thead> 
                <tbody> 
                    <?php foreach ($users as $user): ?> 
                        <tr> 
                            <td><?= htmlspecialchars($user['username']) ?></td> 
                            <td><?= htmlspecialchars($user['full_name']) ?></td> 
                            <td><?= htmlspecialchars($user['email']) ?></td> 
                            <td><?= $user['created_at'] ?></td> 
                            <td> 
                                <a href="edit_user.php?id=<?= $user['user_id'] ?>" class="btn btn-sm btn-warning">แก้ไข</a> 
                                <!-- <a href="users.php?delete=<?= $user['user_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('คุณต้องการลบสมาชิกหรือไม่?')">ลบ</a>  -->

                        <form action="del_sweet.php" method="POST" style="display:inline;">
                    <input type="hidden" name="u_id" value="<?php echo $user['user_id']; ?>">
                    <button type="button" class="delete-button btn btn-danger btn-sm " data-user-id="<?php echo
                    $user['user_id']; ?>"> ลบ </button>
                    </form>

                            </td> 
                        </tr> 
                    <?php endforeach; ?> 
                </tbody> 
            </table> 
        <?php endif; ?> 

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let table = new DataTable('#productTable');
    </script>


<script>
// ฟังกช์ นั ส ำหรับแสดงกลอ่ งยนื ยัน SweetAlert2
function showDeleteConfirmation(userId) {
Swal.fire({
title: 'คุณแน่ใจหรือไม่?',
text: 'คุณจะไม่สามารถเรียกคืนข้อมูลกลับได ้!',
icon: 'warning',
showCancelButton: true,
confirmButtonText: 'ลบ',
cancelButtonText: 'ยกเลิก',
}).then((result) => {
if (result.isConfirmed) {
// หากผู้ใช้ยืนยันให้ส่งค่าฟอร์มไปยัง delete.php เพื่อลบข้อมูล
const form = document.createElement('form');
form.method = 'POST';
form.action = 'delUser_Sweet.php';
const input = document.createElement('input');
input.type = 'hidden';
input.name = 'u_id';
input.value = userId;
form.appendChild(input);
document.body.appendChild(form);
form.submit();
}
});
}
// แนบตัวตรวจจับเหตุกำรณ์คลิกกับองค์ปุ ่่มลบทั ่ ้งหมดที่มีคลำส delete-button
const deleteButtons = document.querySelectorAll('.delete-button');
deleteButtons.forEach((button) => {
button.addEventListener('click', () => {
const userId = button.getAttribute('data-user-id');
showDeleteConfirmation(userId);
});
});
</script>


</body> 
</html>