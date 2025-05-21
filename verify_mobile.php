<?php
session_start();
if (!isset($_SESSION['SESS_AADHAAR'])) {
    header("Location: login.php");
    exit();
}

// Display masked mobile
$mobile = $_SESSION['SESS_MOBILE'];
$masked_mobile = substr($mobile, 0, 2) . "" . substr($mobile, -2);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verify Mobile</title>
    <link href="your-bootstrap.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3>Mobile Verification</h3>
    <p>An OTP has been sent to your registered mobile number ending in <strong><?php echo $masked_mobile; ?></strong>.</p>
    <form action="otp_verify_action.php" method="post">
        <div class="mb-3">
            <label for="otp" class="form-label">Enter OTP</label>
            <input type="text" class="form-control" id="otp" name="otp" required>
        </div>
        <button type="submit" class="btn btn-primary">Verify OTP</button>
    </form>
</div>
</body>
</html>