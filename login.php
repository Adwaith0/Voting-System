<?php
if(!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['SESS_NAME']) && $_SESSION['SESS_NAME'] != "") {
    header("Location: voter.php");
    exit();
}
include "header.php"; 
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg animate__animated animate__fadeIn">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0 text-center">
                        <i class="fas fa-user-lock me-2"></i>Voter Login
                    </h3>
                </div>
                <div class="card-body p-4">
                    <!-- Greeting Message -->
                    <?php if(isset($nam) && !empty($nam)): ?>
                    <div class="alert alert-info d-flex align-items-center">
                        <i class="fas fa-info-circle me-2"></i>
                        <span><?php echo htmlspecialchars($nam); ?></span>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Error Message -->
                    <?php if(isset($error) && !empty($error)): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <?php echo htmlspecialchars($error); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif; ?>
                    
                    <!-- Login Form -->
                    <form action="login_action.php" method="post" id="myform" class="needs-validation" novalidate>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" id="username" name="username" 
                                       required maxlength="50" placeholder="Enter your username">
                            </div>
                            <div class="invalid-feedback">Please enter your username</div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input type="password" class="form-control" id="password" name="password" 
                                       required placeholder="Enter your password">
                                <button class="btn btn-outline-secondary toggle-password" type="button">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="invalid-feedback">Please enter your password</div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" name="login" class="btn btn-primary btn-lg">
                                <i class="fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </div>
                        
                        <div class="text-center mt-3">
                            <a href="register.php" class="text-decoration-none">
                                <i class="fas fa-user-plus me-1"></i>Create new account
                            </a>
                            <span class="mx-2">|</span>
                            <a href="forgot_password.php" class="text-decoration-none">
                                <i class="fas fa-key me-1"></i>Forgot password?
                            </a>
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