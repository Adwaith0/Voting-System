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
   <!-- Modern Marquee Replacement with Logo -->
<div class="marquee-custom animate_animated animate_fadeInDown">
    <div class="container d-flex align-items-center justify-content-center gap-3">
        <!-- Logo Image -->
        <img src="assets/newlogo.png" alt="SecureVote Logo" style="height: 70px; width: auto;">
        <span>
            
            <strong>SecureVote</strong> - Your Trusted Online Voting Platform
        </span>
    </div>
</div>


<!-- Navigation Bar -->
<div class="container nav-custom animate_animated animate_fadeIn">
    <div class="row justify-content-center">
        <div class="col-auto text-center">
            <a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                <i class="fas fa-home me-2"></i>Home
            </a>
            <a href="results.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'results.php' ? 'active' : ''; ?>">
                <i class="fas fa-poll me-2"></i>Results
            </a>
             <a href="admin_login.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'admin_login.php' ? 'active' : ''; ?>">
                <i class="fas fa-lock me-2"></i>Admin Login
            </a>
        </div>
    </div>
</div>


    <!-- Main Content Container -->
    <div class="container">