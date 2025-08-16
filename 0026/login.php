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
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-attachment: fixed;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(79, 172, 254, 0.2) 0%, transparent 50%);
            z-index: -1;
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .login-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            border-radius: 20px 20px 0 0;
            padding: 2rem;
            text-align: center;
        }
        
        .login-header h2 {
            margin: 0;
            font-weight: 600;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .login-body {
            padding: 2.5rem;
        }
        
        .form-control {
            border: 2px solid #e3f2fd;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: rgba(227, 242, 253, 0.3);
        }
        
        .form-control:focus {
            border-color: #4facfe;
            box-shadow: 0 0 0 0.2rem rgba(79, 172, 254, 0.25);
            background: white;
        }
        
        .form-label {
            font-weight: 600;
            color: #37474f;
            margin-bottom: 8px;
        }
        
        .input-group {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #78909c;
            z-index: 5;
        }
        
        .form-control.with-icon {
            padding-left: 45px;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 16px;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(79, 172, 254, 0.4);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 172, 254, 0.6);
            color: white;
        }
        
        .btn-register {
            color: #4facfe;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid #4facfe;
            border-radius: 12px;
            padding: 12px 30px;
            background: transparent;
        }
        
        .btn-register:hover {
            background: #4facfe;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(79, 172, 254, 0.3);
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            font-weight: 500;
            margin-bottom: 2rem;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #4caf50 0%, #81c784 100%);
            color: white;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #f44336 0%, #ef5350 100%);
            color: white;
        }
        
        .login-footer {
            text-align: center;
            padding: 1rem;
            color: #78909c;
            font-size: 14px;
        }
        

        
        @media (max-width: 768px) {
            .login-container {
                margin: 20px;
                border-radius: 15px;
            }
            
            .login-header {
                padding: 1.5rem;
                border-radius: 15px 15px 0 0;
            }
            
            .login-body {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="col-md-6 col-lg-5">
            <!-- Success Alert -->
            <?php if (isset($_GET['register']) && $_GET['register'] === 'success'): ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    สมัครสมาชิกสำเร็จ กรุณาเข้าสู่ระบบ
                </div>
            <?php endif; ?>

            <!-- Error Alert -->
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <!-- Login Card -->
            <div class="login-container">
                <!-- Header -->
                <div class="login-header">
                    <i class="fas fa-user-circle fa-3x mb-3"></i>
                    <h2>เข้าสู่ระบบ</h2>
                    <p class="mb-0 opacity-75">ยินดีต้อนรับกลับมา</p>
                </div>

                <!-- Body -->
                <div class="login-body">
                    <form method="post">
                        <!-- Username/Email Field -->
                        <div class="mb-4">
                            <label for="username_or_email" class="form-label">
                                <i class="fas fa-user me-2"></i>ชื่อผู้ใช้หรืออีเมล
                            </label>
                            <div class="input-group">
                                <i class="fas fa-envelope input-icon"></i>
                                <input type="text" 
                                       name="username_or_email" 
                                       id="username_or_email" 
                                       class="form-control with-icon" 
                                       placeholder="กรอกชื่อผู้ใช้หรืออีเมล"
                                       required>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="mb-4">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock me-2"></i>รหัสผ่าน
                            </label>
                            <div class="input-group">
                                <i class="fas fa-key input-icon"></i>
                                <input type="password" 
                                       name="password" 
                                       id="password" 
                                       class="form-control with-icon" 
                                       placeholder="กรอกรหัสผ่าน"
                                       required>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-grid gap-3">
                            <button type="submit" class="btn btn-login">
                                <i class="fas fa-sign-in-alt me-2"></i>เข้าสู่ระบบ
                            </button>
                            <a href="register.php" class="btn btn-register text-center">
                                <i class="fas fa-user-plus me-2"></i>สมัครสมาชิก
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add smooth animation when page loads
        document.addEventListener('DOMContentLoaded', function() {
            const loginContainer = document.querySelector('.login-container');
            loginContainer.style.opacity = '0';
            loginContainer.style.transform = 'translateY(50px)';
            
            setTimeout(() => {
                loginContainer.style.transition = 'all 0.6s ease';
                loginContainer.style.opacity = '1';
                loginContainer.style.transform = 'translateY(0)';
            }, 100);
        });

        // Add floating effect to input focus
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
                this.parentElement.style.transition = 'transform 0.3s ease';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>