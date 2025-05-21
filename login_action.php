<?php
session_start();
include("dbconnect.php"); // include DB connection

if (isset($_POST['login'])) {
    $aadhaar = mysqli_real_escape_string($conn, $_POST['aadhaar']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Validate Aadhaar and password
    $query = "SELECT * FROM voters WHERE aadhaar='$aadhaar' AND password=MD5('$password')";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['SESS_NAME'] = $row['name'];
        $_SESSION['SESS_AADHAAR'] = $row['aadhaar'];
        $_SESSION['SESS_MOBILE'] = $row['mobile'];

        // Redirect to mobile number verification
        header("Location: verify_mobile.php");
        exit();
    } else {
        $error = "Invalid Aadhaar or password!";
        include("login.php");
    }
}
?>