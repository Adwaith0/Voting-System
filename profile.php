<?php
if(!isset($_SESSION)) { 
    session_start();
}
include "auth.php";
include "header_voter.php";
include "connection.php";
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg animate__animated animate__fadeIn">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-user-circle me-2"></i>Voter Profile</h3>
                        <span class="badge bg-light text-dark">
                            <i class="fas fa-user me-1"></i><?php echo htmlspecialchars($_SESSION['SESS_NAME']); ?>
                        </span>
                    </div>
                </div>
                
                <div class="card-body">
                    <?php
                    $username = mysqli_real_escape_string($con, $_SESSION['SESS_NAME']);
                    $query = 'SELECT status, voted FROM voters WHERE username="'.$username.'"';
                    
                    if ($result = mysqli_query($con, $query)) {
                        if (mysqli_num_rows($result) > 0) {
                            $row = mysqli_fetch_assoc($result);
                            
                            if ($row['status'] == "VOTED") {
                                echo '<div class="alert alert-success">';
                                echo '<i class="fas fa-check-circle me-2"></i>';
                                echo 'You have voted for: <strong>' . htmlspecialchars($row['voted']) . '</strong>';
                                echo '</div>';
                                
                                // Display vote confirmation details
                                echo '<div class="card mb-3">';
                                echo '<div class="card-body">';
                                echo '<h5><i class="fas fa-info-circle me-2 text-primary"></i>Vote Details</h5>';
                                echo '<ul class="list-group list-group-flush">';
                                echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                                echo '<span><i class="fas fa-calendar-alt me-2"></i>Vote Date:</span>';
                                echo '<span>' . date('F j, Y') . '</span>';
                                echo '</li>';
                                echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                                echo '<span><i class="fas fa-fingerprint me-2"></i>Voter ID:</span>';
                                echo '<span>' . substr(md5($username), 0, 8) . '</span>'; // Example voter ID
                                echo '</li>';
                                echo '</ul>';
                                echo '</div>';
                                echo '</div>';
                            } else {
                                echo '<div class="alert alert-warning">';
                                echo '<i class="fas fa-exclamation-triangle me-2"></i>';
                                echo 'You have not voted yet. ';
                                echo '<a href="voter.php" class="alert-link">Click here to vote</a>';
                                echo '</div>';
                            }
                        } else {
                            echo '<div class="alert alert-danger">';
                            echo '<i class="fas fa-exclamation-circle me-2"></i>';
                            echo 'Profile information not found.';
                            echo '</div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger">';
                        echo '<i class="fas fa-exclamation-circle me-2"></i>';
                        echo 'Error retrieving profile information.';
                        echo '</div>';
                        error_log("Database error: " . mysqli_error($con));
                    }
                    ?>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <a href="change_pass.php" class="btn btn-outline-primary me-md-2">
                            <i class="fas fa-key me-1"></i>Change Password
                        </a>
                        <a href="logout.php" class="btn btn-outline-danger">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>