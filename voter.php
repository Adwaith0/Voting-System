<?php
if(!isset($_SESSION)) { 
    session_start();
}
include "auth.php";
include "header_voter.php"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecureVote - Cast Your Vote</title>
    
    <!-- Required CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .voting-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .card-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }
        .party-logo {
            font-size: 1.2rem;
            vertical-align: middle;
        }
        .form-check-input {
            width: 1.2em;
            height: 1.2em;
            margin-top: 0.2em;
        }
        .form-check-label {
            font-size: 1.1rem;
            cursor: pointer;
            padding-left: 0.5rem;
        }
        .text-blue {
            color: #0d6efd;
        }
        .voting-options {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card voting-card animate__animated animate__fadeIn">
                    <div class="card-header text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="mb-0"><i class="fas fa-vote-yea me-2"></i>Cast Your Vote</h3>
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-user me-1"></i><?php echo htmlspecialchars($_SESSION['SESS_NAME']); ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <?php if(isset($msg) && !empty($msg)): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle me-2"></i>
                            <?php echo htmlspecialchars($msg); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>
                        
                        <?php if(isset($error) && !empty($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <?php echo htmlspecialchars($error); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>
                        
                        <form action="submit_vote.php" name="vote" method="post" id="myform">
                            <h4 class="text-center mb-4">
                                <i class="fas fa-question-circle me-2"></i>
                                What is your favorite political party?
                            </h4>
                            
                            <div class="voting-options">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="lan" id="bjp" value="BJP" required>
                                    <label class="form-check-label" for="bjp">
                                        <span class="party-logo me-2"><i class="fas fa-lotus text-danger"></i></span>
                                        Bharatiya Janata Party (BJP)
                                    </label>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="lan" id="congress" value="CONGRESS">
                                    <label class="form-check-label" for="congress">
                                        <span class="party-logo me-2"><i class="fas fa-hand text-blue"></i></span>
                                        Indian National Congress (CONGRESS)
                                    </label>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="lan" id="aap" value="AAP">
                                    <label class="form-check-label" for="aap">
                                        <span class="party-logo me-2"><i class="fas fa-broom text-blue"></i></span>
                                        Aam Aadmi Party (AAP)
                                    </label>
                                </div>
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="lan" id="nota" value="NOTA">
                                    <label class="form-check-label" for="nota">
                                        <span class="party-logo me-2"><i class="fas fa-ban text-danger"></i></span>
                                        None of the Above (NOTA)
                                    </label>
                                </div>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Vote
                                </button>
                            </div>
                            
                            <div class="text-center mt-3 text-muted">
                                <small>Your vote is confidential and cannot be changed once submitted</small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add confirmation dialog before submitting
        const form = document.getElementById('myform');
        form.addEventListener('submit', function(e) {
            const selectedOption = document.querySelector('input[name="lan"]:checked');
            if (!selectedOption) {
                e.preventDefault();
                alert('Please select a party to vote for');
                return;
            }
            
            if (!confirm(`You are about to vote for ${selectedOption.nextElementSibling.textContent.trim()}. This action cannot be undone. Confirm your vote?`)) {
                e.preventDefault();
            }
        });
    });
    </script>

    <?php include "footer.php"; ?>
</body>
</html>