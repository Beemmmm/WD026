<?php

require_once '../config.php'; 
require_once 'auth_admin.php'; // ตรวจสอบสิทธิ์admin

// ตรวจสอบการส่งข้อมูลจากฟอร์ม
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['u_id'])) {
$user_id = $_POST['u_id'];

// ลบผู้ใช้จากฐานข้อมูล
$stmt = $conn->prepare("DELETE FROM users WHERE user_id = ? AND role = 'member'"); 
        $stmt->execute([$user_id]); 

// ส่งผลลัพธ์กลับไปยังหน้า 68users.php
header("Location: users.php"); 
    exit; 
}

?>