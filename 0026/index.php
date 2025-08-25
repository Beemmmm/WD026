<?php
session_start();
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
<body class="floating-elements">
    <div class="container-fluid py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="main-container p-5">
                    <div class="text-center mb-4">
                       
                        <h1 class="welcome-header mb-4"> ยินดีต้อนรับสู่หน้าหลัก </h1>
                    </div>
                    
                    <div class="user-info-card p-4 mb-4">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                                    <i class="bi bi-person-circle text-primary fs-4"></i>
                                </div>
                            </div>
                            <div class="col">
                                <p class="mb-1 text-muted small">ผู้ใช้งานระบบ</p>
                                <h5 class="mb-0 text-primary fw-bold"><?=htmlspecialchars($_SESSION['username'])?></h5>
                                <div class="mt-2">
                                    <span class="role-badge"><?=$_SESSION['role'] ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="logout.php" class="btn btn-custom-logout">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            ออกจากระบบ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
