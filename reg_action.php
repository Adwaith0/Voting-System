<?php
session_start();
include "connection.php"; 

if (isset($_POST['submit'])) {
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $aadhar = mysqli_real_escape_string($con, $_POST['aadhar']);

    // Check if username already exists
    $checkQuery = mysqli_query($con, "SELECT username FROM loginusers WHERE username = '$username'");
    if (mysqli_num_rows($checkQuery) > 0) {
        $nam = "<center><h4><font color='#FF0000'>The username already exists. Please choose another.</h4></center></font>";
        include('register.php');
        exit();
    }

    // Insert into voters table
    $insertVoter = mysqli_query($con, "
        INSERT INTO voters (firstname, lastname, username)
        VALUES ('$firstname', '$lastname', '$username')
    ");
    if (!$insertVoter) {
        die("Voter insert failed: " . mysqli_error($con));
    }

    // Insert into loginusers with aadhar number
    $insertLogin = mysqli_query($con, "
        INSERT INTO loginusers (username, password, aadhar_no)
        VALUES ('$username', '" . md5($password) . "', '$aadhar')
    ");
    if (!$insertLogin) {
        die("Login insert failed: " . mysqli_error($con));
    }

    echo "✅ Successfully Registered! <a href='login.php'>Click here to Login</a>";
} else {
    $error = "<center><h4><font color='#FF0000'>Registration Failed Due To Error!</h4></center></font>";
    include "register.php";
}
?>
