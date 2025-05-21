<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecureVote - Voter Dashboard</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .voter-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 15px 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .nav-link {
            color: rgba(255,255,255,0.85);
            font-weight: 500;
            margin: 0 10px;
            padding: 8px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        .nav-link:hover, .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.15);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <!-- Voter Header Navigation -->
    <header class="voter-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="fas fa-vote-yea fa-lg me-2"></i>
                    <h4 class="mb-0">SecureVote</h4>
                </div>
                
                <div class="d-flex align-items-center">
                    <nav class="nav">
                        <a href="voter.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'voter.php' ? 'active' : ''; ?>">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                        <a href="lan_view.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'lan_view.php' ? 'active' : ''; ?>">
                            <i class="fas fa-chart-bar me-1"></i> Results
                        </a>
                        <a href="profile.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : ''; ?>">
                            <i class="fas fa-user me-1"></i> Profile
                        </a>
                        <a href="change_pass.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'change_pass.php' ? 'active' : ''; ?>">
                            <i class="fas fa-key me-1"></i> Password
                        </a>
                    </nav>
                    
                    <div class="user-profile ms-4">
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <div class="fw-bold small"><?php echo isset($_SESSION['SESS_NAME']) ? htmlspecialchars($_SESSION['SESS_NAME']) : 'Guest'; ?></div>
                            <a href="logout.php" class="text-white small" style="text-decoration: none;">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="container my-4">