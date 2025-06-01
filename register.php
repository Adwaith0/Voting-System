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
        <div class="col-md-8 col-lg-6">
            <div class="card register-card">
                <div class="card-header">
                    <h3 class="text-center">Register for Voting</h3>
                </div>
                <div class="card-body">
                    <?php if(isset($nam)): ?>
                    <div class="alert alert-info"><?php echo $nam; ?></div>
                    <?php endif; ?>
                    
                    <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <form action="reg_action.php" method="post" id="myform">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstname">First Name</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter your first name">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter your last name">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Choose a username">
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Create a password (min 6 characters)">
                            <small class="form-text text-muted">Password must be at least 6 characters long</small>
                        </div>
                        
                        <div class="form-group text-center">
                            <div class="g-recaptcha d-inline-block" data-sitekey="6LeD3hEUAAAAAKne6ua3iVmspK3AdilgB6dcjST0"></div>
                        </div>
                        
                        <div class="form-group text-center">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>Already have an account? <a href="login.php">Login here</a></small>
                </div>
            </div>
        </div>
    </div>
</div>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
var frmvalidator = new Validator("myform"); 
frmvalidator.addValidation("firstname","req","Please enter your firstname"); 
frmvalidator.addValidation("firstname","maxlen=50");
frmvalidator.addValidation("lastname","req","Please enter your lastname"); 
frmvalidator.addValidation("lastname","maxlen=50");
frmvalidator.addValidation("username","req","Please enter a username"); 
frmvalidator.addValidation("username","maxlen=50");
frmvalidator.addValidation("password","req","Please enter a password"); 
frmvalidator.addValidation("password","minlen=6","Password must not be less than 6 characters.");
</script>

<style>
    .register-card {
        margin-top: 30px;
        margin-bottom: 30px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border: none;
        border-radius: 10px;
    }
    
    .register-card .card-header {
        background-color: #343a40;
        color: white;
        border-radius: 10px 10px 0 0 !important;
        padding: 15px;
    }
    
    .register-card .card-body {
        padding: 30px;
    }
    
    .register-card .form-control {
        height: 45px;
        border-radius: 5px;
    }
    
    .register-card .btn {
        padding: 10px;
        border-radius: 5px;
        background-color: #343a40;
        border: none;
        margin-top: 15px;
    }
    
    .register-card .btn:hover {
        background-color: #495057;
    }
    
    .register-card .g-recaptcha {
        margin: 15px 0;
    }
    
    body {
        background-color: #f8f9fa;
    }
</style>

<?php include "footer.php"; ?>