<?php
if(!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['SESS_NAME']) && $_SESSION['SESS_NAME'] != "") {
    header("Location: voter.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecureVote - Registration</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google reCAPTCHA -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .registration-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .registration-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 20px;
        }
        .password-strength {
            height: 5px;
            margin-top: 5px;
            background-color: #e9ecef;
            border-radius: 3px;
            overflow: hidden;
        }
        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(42, 82, 152, 0.25);
        }
    </style>
</head>
<body>
    <?php include "header.php"; ?>
    
    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="registration-card">
                    <div class="registration-header text-center">
                        <h3><i class="fas fa-user-plus me-2"></i>Create Your Voter Account</h3>
                        <p class="mb-0">Join our secure voting platform</p>
                    </div>
                    
                    <div class="card-body p-4">
                        <?php if(isset($nam) && !empty($nam)): ?>
                        <div class="alert alert-info alert-dismissible fade show">
                            <?php echo htmlspecialchars($nam); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>
                        
                        <?php if(isset($error) && !empty($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?php echo htmlspecialchars($error); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php endif; ?>
                        
                        <form action="reg_action.php" method="post" id="myform" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" id="firstname" name="firstname" 
                                               required maxlength="50" placeholder="Enter your first name">
                                    </div>
                                    <div class="invalid-feedback">Please enter your first name</div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" id="lastname" name="lastname" 
                                               required maxlength="50" placeholder="Enter your last name">
                                    </div>
                                    <div class="invalid-feedback">Please enter your last name</div>
                                </div>
                            </div>

                            <div class="mb-3">
    <label for="aadhar" class="form-label">Aadhar Number</label>
    <div class="input-group">
        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
        <input type="text" class="form-control" id="aadhar" name="aadhar" 
               required pattern="\d{12}" maxlength="12" placeholder="Enter 12-digit Aadhar number">
    </div>
    <div class="invalid-feedback">Please enter a valid 12-digit Aadhar number</div>
</div>

<div class="mb-3">
    <label for="mobile" class="form-label">Mobile Number</label>
    <div class="input-group">
        <span class="input-group-text"><i class="fas fa-phone"></i></span>
        <input type="tel" class="form-control" id="mobile" name="mobile" 
               required pattern="\d{10}" maxlength="10" placeholder="Enter 10-digit mobile number">
    </div>
    <div class="invalid-feedback">Please enter a valid 10-digit mobile number</div>
</div>

                            
<div class="mb-3">
    <label for="otp" class="form-label">OTP</label>
    <div class="input-group">
        <input type="text" class="form-control" id="otp" name="otp" 
               required placeholder="Enter OTP sent to your mobile" maxlength="6">
        <button type="button" class="btn btn-outline-primary" id="sendOtpBtn">
            <i class="fas fa-paper-plane me-1"></i>Send OTP
        </button>
    </div>
    <div class="invalid-feedback">Please enter the OTP sent to your mobile</div>
</div>

                            
                            


                            
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" 
                                           required minlength="6" placeholder="Create a password">
                                    <button class="btn btn-outline-secondary toggle-password" type="button">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="password-strength mt-2">
                                    <div class="password-strength-bar" id="password-strength-bar"></div>
                                </div>
                                <div class="invalid-feedback">Password must be at least 6 characters</div>
                                <small class="text-muted">Minimum 6 characters</small>
                            </div>
                            
                            <div class="mb-4">
                                <div class="g-recaptcha" data-sitekey="6LeD3hEUAAAAAKne6ua3iVmspK3AdilgB6dcjST0"></div>
                                <div class="invalid-feedback d-block">Please complete the CAPTCHA</div>
                            </div>
                            
                            <div class="d-grid gap-2">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-arrow-right me-2"></i>Continue
                                </button>
                            </div>
                            
                            <div class="text-center mt-3">
                                <p>Already have an account? <a href="login.php">Sign in</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

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
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('password-strength-bar');

        passwordInput.addEventListener('input', function() {
            const strength = calculatePasswordStrength(this.value);
            strengthBar.style.width = strength.percentage + '%';
            strengthBar.style.backgroundColor = strength.color;
        });

        function calculatePasswordStrength(password) {
            let strength = 0;
            
            // Length check
            if (password.length >= 6) strength += 1;
            if (password.length >= 8) strength += 1;
            
            // Complexity checks
            if (/[A-Z]/.test(password)) strength += 1;
            if (/[0-9]/.test(password)) strength += 1;
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;
            
            // Determine percentage and color
            const percentage = Math.min(strength * 25, 100);
            let color = '#dc3545'; // red
            
            if (strength >= 3) color = '#ffc107'; // yellow
            if (strength >= 5) color = '#28a745'; // green
            
            return { percentage, color };
        }

        // Form validation
        const form = document.getElementById('myform');
        form.addEventListener('submit', function(event) {
            // Validate reCAPTCHA
            const recaptchaResponse = grecaptcha.getResponse();
            if (recaptchaResponse.length === 0) {
                event.preventDefault();
                document.querySelector('.g-recaptcha').classList.add('is-invalid');
            } else {
                document.querySelector('.g-recaptcha').classList.remove('is-invalid');
            }
            
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // Simulate OTP sending
document.getElementById('sendOtpBtn').addEventListener('click', function() {
    const mobile = document.getElementById('mobile').value;
    if (/^\d{10}$/.test(mobile)) {
        alert("OTP sent to mobile number: " + mobile);
        // You can integrate actual OTP sending using Twilio / SMS API here
    } else {
        alert("Please enter a valid 10-digit mobile number before requesting OTP.");
    }
});

    </script>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php include "footer.php"; ?>
</body>
</html>