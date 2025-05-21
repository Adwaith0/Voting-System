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
    <title>SecureVote - Change Password</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .password-card {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .card-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }
        .password-strength {
            height: 5px;
            margin-top: 5px;
            background-color: #e9ecef;
            border-radius: 3px;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(42, 82, 152, 0.25);
            border-color: #2a5298;
        }
        .input-group-text {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card password-card animate__animated animate__fadeIn">
                    <div class="card-header text-white">
                        <h3 class="card-title mb-0 text-center">
                            <i class="fas fa-key me-2"></i>Change Password
                        </h3>
                    </div>
                    
                    <div class="card-body p-4">
                        <!-- User Greeting -->
                        <?php if(isset($nam) && !empty($nam)): ?>
                        <div class="alert alert-info d-flex align-items-center">
                            <i class="fas fa-user-circle me-2 fs-4"></i>
                            <span><?php echo htmlspecialchars($nam); ?></span>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Error Message -->
                        <?php if(isset($error) && !empty($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <?php echo htmlspecialchars($error); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>
                        
                        <!-- Password Change Form -->
                        <form action="change_pass_action.php" method="post" id="myform" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="cpassword" class="form-label">Current Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="cpassword" name="cpassword" required>
                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback">Please enter your current password</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="npassword" class="form-label">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    <input type="password" class="form-control" id="npassword" name="npassword" required
                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                                           title="Must contain at least 8 characters, including uppercase, lowercase, and number">
                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback">
                                    Password must be at least 8 characters with uppercase, lowercase, and number
                                </div>
                                <div class="password-strength mt-2">
                                    <div id="password-strength-bar" class="progress-bar" role="progressbar"></div>
                                </div>
                                <small class="text-muted">Minimum 8 characters with uppercase, lowercase, and number</small>
                            </div>
                            
                            <div class="mb-4">
                                <label for="cnpassword" class="form-label">Confirm New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-check-circle"></i></span>
                                    <input type="password" class="form-control" id="cnpassword" name="cnpassword" required>
                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="invalid-feedback">Please confirm your new password</div>
                                <div id="password-match-feedback" class="mt-1 small"></div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" name="cpass" value="UPDATE" class="btn btn-primary btn-lg">
                                    <i class="fas fa-sync-alt me-2"></i>Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.closest('.input-group').querySelector('input');
                const icon = this.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.replace('fa-eye', 'fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.replace('fa-eye-slash', 'fa-eye');
                }
            });
        });

        // Password strength indicator
        const passwordInput = document.getElementById('npassword');
        const strengthBar = document.getElementById('password-strength-bar');
        const confirmPasswordInput = document.getElementById('cnpassword');
        const matchFeedback = document.getElementById('password-match-feedback');

        passwordInput.addEventListener('input', function() {
            const strength = checkPasswordStrength(this.value);
            strengthBar.style.width = strength.percentage + '%';
            strengthBar.className = 'progress-bar ' + strength.class;
        });

        confirmPasswordInput.addEventListener('input', function() {
            if (this.value !== passwordInput.value) {
                matchFeedback.textContent = 'Passwords do not match';
                matchFeedback.style.color = 'red';
            } else {
                matchFeedback.textContent = 'Passwords match';
                matchFeedback.style.color = 'green';
            }
        });

        function checkPasswordStrength(password) {
            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            const percentage = Math.min(strength * 25, 100);
            let colorClass = 'bg-danger'; // red
            
            if (strength >= 3) colorClass = 'bg-warning'; // yellow
            if (strength >= 5) colorClass = 'bg-success'; // green
            
            return { percentage, class: colorClass };
        }

        // Form validation
        const form = document.getElementById('myform');
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
    </script>

    <?php include "footer.php"; ?>
</body>
</html>