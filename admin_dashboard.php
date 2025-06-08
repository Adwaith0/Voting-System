<?php
session_start();
include('connection.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - SecureVote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f1f3f4;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #1a1a2e;
            padding-top: 1rem;
        }
        .sidebar .nav-link {
            color: #bbb;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 16px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: #fff;
            background-color: #16213e;
        }
        .main-content {
            padding: 30px;
        }
        .card {
            border: none;
            border-radius: 15px;
            color: #fff;
        }
        .card-blue {
            background: linear-gradient(45deg, #3a7bd5, #00d2ff);
        }
        .card-green {
            background: linear-gradient(45deg, #38ef7d, #11998e);
        }
        .card-title {
            font-weight: 600;
        }
        .header-bar {
            background: linear-gradient(to right, #1f4037, #99f2c8);
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .header-bar h1 {
            font-weight: bold;
        }
        .welcome {
            font-size: 18px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="admin_dashboard.php">
                            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_candidates.php">
                            <i class="fas fa-users me-2"></i> Manage Candidates
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="view_results.php">
                            <i class="fas fa-poll me-2"></i> View Results
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_logout.php">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 main-content">
                <div class="header-bar d-flex justify-content-between align-items-center">
                    <h1>Admin Dashboard</h1>
                    <span class="welcome">Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?> 👋</span>
                </div>

                <div class="row g-4">
                    <!-- Total Candidates -->
                    <div class="col-md-6 col-xl-4">
                        <div class="card card-blue shadow">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-user-plus me-2"></i> Total Candidates</h5>
                                <h1 class="display-5">
                                    <?php
                                    $query = "SELECT COUNT(*) FROM candidates";
                                    $result = $con->query($query);
                                    echo $result->fetch_row()[0];
                                    ?>
                                </h1>
                            </div>
                        </div>
                    </div>

                    <!-- Total Votes Cast -->
                    <div class="col-md-6 col-xl-4">
                        <div class="card card-green shadow">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-vote-yea me-2"></i> Total Votes Cast</h5>
                                <h1 class="display-5">
                                    <?php
                                    $query = "SELECT COUNT(*) FROM voters WHERE status = 'VOTED'";
                                    $result = $con->query($query);
                                    echo $result->fetch_row()[0];
                                    ?>
                                </h1>
                            </div>
                        </div>
                    </div>

                    <!-- You can add more cards below similarly -->
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
