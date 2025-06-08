<?php
session_start();
include('connection.php');

// Hardcoded admin credentials (for demo purposes only)
// In production, use database-stored hashed passwords
$admin_username = "admin";
$admin_password = "admin123"; // In production, use password_hash()

// Get submitted credentials
$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

// Validate credentials
if ($username === $admin_username && $password === $admin_password) {
    // Successful login
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = $username;
    header('Location: admin_dashboard.php');
    exit;
} else {
    // Failed login
    $_SESSION['login_error'] = "Invalid username or password";
    header('Location: admin_login.php');
    exit;
}
?>