<?php
session_start();
include('connection.php');

// Verify admin access
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}

// Get voting results from your database structure
$results = $con->query("
    SELECT 
        l.lan_id as id,
        l.fullname as name,
        l.about as party,
        l.votecount as votes,
        'Election' as position  -- Adding position since your table doesn't have this
    FROM languages l
    ORDER BY l.votecount DESC
");

// Get total voters count
$total_voters = $con->query("SELECT COUNT(*) as total FROM voters")->fetch_assoc()['total'];

// Get voted voters count
$voted_voters = $con->query("SELECT COUNT(*) as voted FROM voters WHERE status = 'VOTED'")->fetch_assoc()['voted'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Results - SecureVote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.5);
            border-radius: 5px;
            margin-bottom: 5px;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,.1);
        }
        .main-content {
            padding: 20px;
        }
        .winner {
            background-color: #d4edda !important;
            font-weight: bold;
        }
        .stats-card {
            transition: transform 0.3s;
        }
        .stats-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include('admin_sidebar.php'); ?>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Voting Results Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <button class="btn btn-sm btn-outline-secondary" onclick="window.print()">
                            <i class="fas fa-print"></i> Print Results
                        </button>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="card text-white bg-primary stats-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Candidates</h5>
                                <h2 class="card-text"><?php echo $results->num_rows; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success stats-card">
                            <div class="card-body">
                                <h5 class="card-title">Total Voters</h5>
                                <h2 class="card-text"><?php echo $total_voters; ?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-info stats-card">
                            <div class="card-body">
                                <h5 class="card-title">Votes Cast</h5>
                                <h2 class="card-text"><?php echo $voted_voters; ?></h2>
                                <small><?php echo round(($voted_voters/$total_voters)*100, 2); ?>% turnout</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Results Table -->
                <div class="card shadow">
                    <div class="card-header bg-dark text-white">
                        <h4 class="mb-0">Detailed Results</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Position</th>
                                        <th>Candidate</th>
                                        <th>Party</th>
                                        <th>Votes</th>
                                        <th>Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total_votes = $con->query("SELECT SUM(votecount) as total FROM languages")->fetch_assoc()['total'];
                                    $max_votes = 0;
                                    $first_row = true;
                                    
                                    while ($row = $results->fetch_assoc()) {
                                        if ($first_row) {
                                            $max_votes = $row['votes'];
                                            $first_row = false;
                                        }
                                        
                                        $is_winner = ($row['votes'] == $max_votes && $max_votes > 0);
                                        $percentage = $total_votes > 0 ? round(($row['votes']/$total_votes)*100, 2) : 0;
                                    ?>
                                    <tr <?php if ($is_winner) echo 'class="winner"'; ?>>
                                        <td><?php echo htmlspecialchars($row['position']); ?></td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['party']); ?></td>
                                        <td><?php echo $row['votes']; ?></td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: <?php echo $percentage; ?>%" 
                                                     aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100">
                                                    <?php echo $percentage; ?>%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        Last updated: <?php echo date('Y-m-d H:i:s'); ?>
                    </div>
                </div>

                <!-- Admin Actions -->
                <div class="card mt-4 border-danger">
                    <div class="card-header bg-danger text-white">
                        <h4 class="mb-0">Admin Actions</h4>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <strong>Warning:</strong> These actions are restricted to administrators only.
                        </div>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exportModal">
                                <i class="fas fa-file-export"></i> Export Results
                            </button>
                            <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#resetModal">
                                <i class="fas fa-trash-alt"></i> Reset Votes
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Export Modal -->
    <div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Export Results</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Select export format:</p>
                    <div class="d-grid gap-2">
                        <a href="export_results.php?format=csv" class="btn btn-success">
                            <i class="fas fa-file-csv"></i> CSV Format
                        </a>
                        <a href="export_results.php?format=pdf" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> PDF Format
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reset Modal -->
    <div class="modal fade" id="resetModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Reset Voting Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <strong>Warning!</strong> This will reset all vote counts and cannot be undone!
                    </div>
                    <p>Are you sure you want to reset all voting data?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a href="reset_votes.php" class="btn btn-danger">Confirm Reset</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Admin-specific features would be added here
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Admin results dashboard loaded');
        });
    </script>
</body>
</html>