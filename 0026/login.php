<?php
    session_start(); // start the session to use sesstion
    require_once 'config.php';

    $error = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        // รับค่าจากฟอร์ม
        $usernameOrEmail = trim($_POST['username_or_email']);
        $password = ($_POST['password']);

        // เอาค่าที่รับมาจากฟอร์มไปตรวจสอบว่ามีข้อมูลตรงใน db หรือไม่
        $sql = "SELECT * FROM users WHERE (username = ? OR email = ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usernameOrEmail, $usernameOrEmail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])){

        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

            if($user['role'] === 'admin'){
                header("Location: admin/index.php");
            } else {
                header("Location: index.php");
            }
            exit(); // หยุดการทำงานของสคริปต์หลังจากเปลี่ยนเส้นทาง
            }else {
                $error = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background: linear-gradient(135deg, #f8fbff 0%, #e3f2fd 50%, #e1f5fe 100%);
            min-height: 100vh;
            padding-top: 50px;
        }
        
        .container {
            max-width: 500px;
        }
        
        .login-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 8px 25px rgba(33, 150, 243, 0.1);
            border: 1px solid rgba(33, 150, 243, 0.08);
            overflow: hidden;
            margin-top: 30px;
        }
        
        .login-header {
            background: linear-gradient(135deg, #1976d2, #2196f3);
            color: white;
            padding: 30px 0;
            text-align: center;
            margin-bottom: 0;
        }
        
        .login-header h3 {
            margin: 0;
            font-weight: 500;
            font-size: 1.5rem;
        }
        
        .login-body {
            padding: 40px 30px 30px;
        }
        
        .form-control {
            border: 2px solid #e8f4fd;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
            background: #fafbff;
        }
        
        .form-control:focus {
            border-color: #2196f3;
            box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.15);
            background: white;
        }
        
        .form-label {
            color: #455a64;
            font-weight: 500;
            margin-bottom: 8px;
        }
        
        .btn-success {
            background: #2196f3;
            border-color: #2196f3;
            padding: 12px 30px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .btn-success:hover {
            background: #1976d2;
            border-color: #1976d2;
            transform: translateY(-1px);
        }
        
        .btn-link {
            color: #2196f3;
            font-weight: 500;
            text-decoration: none;
            padding: 12px 20px;
        }
        
        .btn-link:hover {
            color: #1976d2;
        }
        
        .alert {
            border: none;
            border-radius: 8px;
            font-weight: 400;
            margin-bottom: 0;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #e8f8f5, #d4edda);
            color: #155724;
            border-left: 4px solid #28a745;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #f8e8e8, #f5c6cb);
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        
        .alert-container {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            width: 90%;
            max-width: 500px;
            animation: slideDown 0.5s ease-out;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translate(-50%, -30px);
            }
            to {
                opacity: 1;
                transform: translate(-50%, 0);
            }
        }
        
        .form-floating-custom {
            position: relative;
        }
        
        .btn-group-custom {
            display: flex;
            gap: 15px;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 0 15px;
            }
            
            .login-body {
                padding: 30px 20px 25px;
            }
            
            .btn-group-custom {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>

<?php if (isset($_GET['register']) && $_GET['register'] === 'success'): ?>
<div class="alert-container">
    <div class="alert alert-success"> สมัครสมาชิกสำเร็จ กรุณาเข้าสู่ระบบ </div>
</div>
<?php endif; ?>

<?php if (!empty($error)): ?>
<div class="alert-container">
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
</div>
<?php endif; ?>

<div class="container mt-5">
    <div class="login-card">
        <div class="login-header">
            <h3>เข้าสู่ระบบ</h3>
        </div>
        
        <div class="login-body">
            <form method="post" class="row g-3">
                <div class="col-md-6">
                    <label for="username_or_email" class="form-label">ชื่อผู้ใช้หรืออีเมล</label>
                    <input type="text" name="username_or_email" id="username_or_email" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">รหัสผ่าน</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="col-12">
                    <div class="btn-group-custom">
                        <button type="submit" class="btn btn-success">เข้าสู่ระบบ</button>
                        <a href="register.php" class="btn btn-link">สมัครสมาชิก</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Auto hide alerts after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alerts = document.querySelectorAll('.alert-container');
        alerts.forEach(function(alert) {
            setTimeout(function() {
                alert.style.opacity = '0';
                alert.style.transform = 'translate(-50%, -30px)';
                setTimeout(function() {
                    alert.remove();
                }, 300);
            }, 5000);
        });
    });
    
    // Add subtle hover effects
    document.querySelectorAll('.form-control').forEach(function(input) {
        input.addEventListener('focus', function() {
            this.style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.style.transform = 'scale(1)';
        });
    });
</script>

</body>
</html>