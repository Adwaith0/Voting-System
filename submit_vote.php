<?php
include "connection.php";
session_start();

// Check if user is logged in
if (!isset($_SESSION['SESS_NAME'])) {
    header("Location: login.php");
    exit();
}

// Initialize variables
$error = '';
$msg = '';

// Validate CSRF token if you implement it
// if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
//     die("Invalid CSRF token");
// }

// Check if language is selected
if (empty($_POST['lan'])) {
    $error = "Please select a political party to vote!";
    include "voter.php";
    exit();
}

// Sanitize input
$lan = mysqli_real_escape_string($con, trim($_POST['lan']));
$username = mysqli_real_escape_string($con, $_SESSION['SESS_NAME']);

// Check valid voting options
$valid_parties = ['BJP', 'CONGRESS', 'AAP', 'NOTA', 'NIRDLIY'];
if (!in_array($lan, $valid_parties)) {
    $error = "Invalid voting option selected!";
    include "voter.php";
    exit();
}

// Check if user has already voted
$stmt = mysqli_prepare($con, 'SELECT * FROM voters WHERE username = ? AND status = "VOTED"');
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $msg = "You have already voted. No need to vote again.";
    include 'voter.php';
    exit();    
}

// Start transaction
mysqli_begin_transaction($con);

try {
    // Update language vote count
    $stmt1 = mysqli_prepare($con, 'UPDATE languages SET votecount = votecount + 1 WHERE fullname = ?');
    mysqli_stmt_bind_param($stmt1, "s", $lan);
    $success1 = mysqli_stmt_execute($stmt1);
    
    // Update voter status
    $stmt2 = mysqli_prepare($con, 'UPDATE voters SET status = "VOTED", voted = ? WHERE username = ?');
    mysqli_stmt_bind_param($stmt2, "ss", $lan, $username);
    $success2 = mysqli_stmt_execute($stmt2);
    
    if ($success1 && $success2) {
        mysqli_commit($con);
        $msg = "Thank you! Your vote for $lan has been recorded.
    } else {
        throw new Exception("Database update failed");
    }
} catch (Exception $e) {
    mysqli_rollback($con);
    $error = "Error processing your vote. Please try again.";
    error_log("Voting error: " . $e->getMessage());
}

// Close statements
if (isset($stmt1)) mysqli_stmt_close($stmt1);
if (isset($stmt2)) mysqli_stmt_close($stmt2);

include 'voter.php';
exit();
?>