<?php
if(!isset($_SESSION)) { 
    session_start();
}
include "auth.php";
include "header_voter.php"; 
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card voting-card">
                <div class="card-header">
                    <h4 class="mb-0">Welcome <?php echo $_SESSION['SESS_NAME']; ?></h4>
                </div>
                <div class="card-body">
                    <h3 class="text-center mb-4">Make Your Vote</h3>
                    
                    <?php if(isset($msg)): ?>
                    <div class="alert alert-info"><?php echo $msg; ?></div>
                    <?php endif; ?>
                    
                    <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <form action="submit_vote.php" name="vote" method="post" id="myform">
                        <div class="form-group">
                            <h5 class="text-center mb-4">What is your favorite political party?</h5>
                            <div class="voting-options">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="lan" id="bjp" value="BJP">
                                    <label class="form-check-label" for="bjp">BJP</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="lan" id="congress" value="CONGRESS">
                                    <label class="form-check-label" for="congress">CONGRESS</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="lan" id="aap" value="AAP">
                                    <label class="form-check-label" for="aap">AAP</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="lan" id="nota" value="NOTA">
                                    <label class="form-check-label" for="nota">NOTA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="lan" id="nirdliy" value="NIRDLIY">
                                    <label class="form-check-label" for="nirdliy">NIRDLIY</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <button type="submit" name="submit" class="btn btn-vote">Submit Vote</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>Your vote is confidential and important</small>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .voting-card {
        margin-top: 30px;
        margin-bottom: 30px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border: none;
        border-radius: 10px;
    }
    
    .voting-card .card-header {
        background-color: #343a40;
        color: white;
        border-radius: 10px 10px 0 0 !important;
        padding: 15px;
    }
    
    .voting-card .card-body {
        padding: 30px;
    }
    
    .voting-options {
        margin: 0 auto;
        max-width: 300px;
    }
    
    .form-check {
        padding: 10px;
        border-bottom: 1px solid #eee;
    }
    
    .form-check-input {
        margin-top: 0.45rem;
    }
    
    .btn-vote {
        padding: 10px 30px;
        border-radius: 5px;
        background-color: #28a745;
        color: white;
        border: none;
        font-weight: bold;
    }
    
    .btn-vote:hover {
        background-color: #218838;
    }
    
    body {
        background-color: #f8f9fa;
    }
</style>

<?php include "footer.php"; ?>