<?php include "header.php"; 
if(!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['SESS_NAME'])!="") {
    header("Location: voter.php");
}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card login-card">
                <div class="card-header">
                    <h3 class="text-center">Login for Voting</h3>
                </div>
                <div class="card-body">
                    <?php if(isset($nam)): ?>
                    <div class="alert alert-info"><?php echo $nam; ?></div>
                    <?php endif; ?>
                    
                    <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <form action="login_action.php" method="post" id="myform">
                        <div class="form-group">
                            <label for="username">Username/Aadhar</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter your username/Aadhar number" maxlength="50">
                            <small class="form-text text-muted">You can use your username or Aadhar number</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>Don't have an account? Contact the administrator</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript"> 
var frmvalidator = new Validator("myform");
frmvalidator.addValidation("username", "req", "Please Enter Username");
frmvalidator.addValidation("username", "maxlen=50");
frmvalidator.addValidation("password", "req", "Please Enter Password");
</script>

<style>
    .login-card {
        margin-top: 50px;
        margin-bottom: 50px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border: none;
        border-radius: 10px;
    }
    
    .login-card .card-header {
        background-color: #343a40;
        color: white;
        border-radius: 10px 10px 0 0 !important;
        padding: 15px;
    }
    
    .login-card .card-body {
        padding: 30px;
    }
    
    .login-card .form-control {
        height: 45px;
        border-radius: 5px;
    }
    
    .login-card .btn {
        padding: 10px;
        border-radius: 5px;
        background-color: #343a40;
        border: none;
    }
    
    .login-card .btn:hover {
        background-color: #495057;
    }
    
    body {
        background-color: #f8f9fa;
    }
</style>

<?php include "footer.php"; ?>