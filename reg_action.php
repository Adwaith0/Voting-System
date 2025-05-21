<?php
session_start();
include "connection.php";

// Initialize variables
$error = '';
$success = '';
$captcha = "";

// Check if form was submitted
if(isset($_POST['submit'])) {
    // Validate reCAPTCHA (uncomment when ready)
    /*
    if (isset($_POST['g-recaptcha-response'])){
        $captcha = $_POST['g-recaptcha-response'];
    }
    if(!$captcha){
        $error = "Please complete the CAPTCHA verification";
        include('register.php');
        exit();
    }
    $secretKey = "6LeD3hEUAAAAADNeeaGRfKmABjn1gnsXxrpdTa2J";
    $ip = $_SERVER['REMOTE_ADDR'];
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
    $responseKeys = json_decode($response, true);
    if(intval($responseKeys["success"]) !== 1) {
        $error = "CAPTCHA verification failed";
        include('register.php');
        exit();
    }
    */

    // Validate and sanitize inputs
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $aadhar = $_POST['aadhar'];
    $mobile = $_POST['mobile'];
    $otp = $_POST['otp']
    $password = $_POST['password'];

    // Input validation
    if(empty($firstname) || empty($lastname) || empty($username) || empty($password)) {
        $error = "All fields are required";
        include('register.php');
        exit();
    }

    if(strlen($password) < 6) {
        $error = "Password must be at least 6 characters long";
        include('register.php');
        exit();
    }

    // Sanitize inputs
    $firstname = mysqli_real_escape_string($con, $firstname);
    $lastname = mysqli_real_escape_string($con, $lastname);
    $username = mysqli_real_escape_string($con, $username);

    // Check if username exists using prepared statement
    $stmt = mysqli_prepare($con, 'SELECT username FROM loginusers WHERE username = ?');
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    
    if(mysqli_stmt_num_rows($stmt) > 0) {
        $error = "<div class='alert alert-danger'><i class='fas fa-exclamation-circle me-2'></i>The username already exists. Please choose another.</div>";
        include('register.php');
        mysqli_stmt_close($stmt);
        exit();
    }
    mysqli_stmt_close($stmt);

    // Hash password securely
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Start transaction
    mysqli_begin_transaction($con);

    try {
        // Insert into voters table
        $stmt1 = mysqli_prepare($con, 'INSERT INTO voters (firstname, lastname, username) VALUES (?, ?, ?)');
        mysqli_stmt_bind_param($stmt1, "sss", $firstname, $lastname, $username);
        $result1 = mysqli_stmt_execute($stmt1);

        // Insert into loginusers table
        $stmt2 = mysqli_prepare($con, 'INSERT INTO loginusers (username, password) VALUES (?, ?)');
        mysqli_stmt_bind_param($stmt2, "ss", $username, $hashed_password);
        $result2 = mysqli_stmt_execute($stmt2);

        if($result1 && $result2) {
            mysqli_commit($con);
            $success = "<div class='alert alert-success'>
                <i class='fas fa-check-circle me-2'></i>Successfully Registered! 
                <a href='login.php' class='alert-link'>Click here to Login</a>
            </div>";
            
            // Display success message on register.php or redirect to login
            include('register.php');
        } else {
            throw new Exception("Database insertion failed");
        }
    } catch (Exception $e) {
        mysqli_rollback($con);
        $error = "<div class='alert alert-danger'><i class='fas fa-exclamation-circle me-2'></i>Registration failed due to an error. Please try again.</div>";
        error_log("Registration error: " . $e->getMessage());
        include('register.php');
    }

    // Close statements
    if(isset($stmt1)) mysqli_stmt_close($stmt1);
    if(isset($stmt2)) mysqli_stmt_close($stmt2);
} else {
    $error = "<div class='alert alert-danger'><i class='fas fa-exclamation-circle me-2'></i>Invalid request method.</div>";
    include('register.php');
}
?>