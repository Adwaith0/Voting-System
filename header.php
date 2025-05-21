<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecureVote - Online Voting System</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            padding-top: 20px;
        }
        .marquee-custom {
            background: linear-gradient(90deg, #4b6cb7 0%, #182848 100%);
            color: white;
            padding: 10px 0;
            font-weight: 500;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .nav-custom {
            background-color: #fff;
            border-radius: 8px;
            padding: 15px 0;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .nav-custom a {
            color: #495057;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .nav-custom a:hover {
            color: #fff;
            background-color: #4b6cb7;
            transform: translateY(-2px);
        }
        .nav-custom a.active {
            color: #fff;
            background-color: #4b6cb7;
        }
    </style>
</head>
<body>
    <!-- Modern Marquee Replacement -->
    <div class="marquee-custom animate__animated animate__fadeInDown">
        <div class="container text-center">
            <i class="fas fa-vote-yea me-2"></i> Welcome to SecureVote - Your Trusted Online Voting Platform
        </div>
    </div>

    <!-- Navigation -->
    <div class="container nav-custom animate__animated animate__fadeIn">
        <div class="row justify-content-center">
            <div class="col-auto text-center">
                <a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                    <i class="fas fa-home me-2"></i>Home
                </a>
                <a href="register.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'register.php' ? 'active' : ''; ?>">
                    <i class="fas fa-user-plus me-2"></i>Register
                </a>
                <a href="login.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : ''; ?>">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="container">