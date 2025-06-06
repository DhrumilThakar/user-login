<?php
session_start();
require_once 'config.php';

if(!isset($_GET['token'])) {
    header("Location: index.php");
    exit();
}

$token = $_GET['token'];
$result = $conn->query("SELECT * FROM users WHERE reset_token = '$token' AND token_expiry > NOW()");

if($result->num_rows == 0) {
    $_SESSION['error'] = "Invalid or expired reset token!";
    header("Location: index.php");
    exit();
}

if(isset($_POST['reset_password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $conn->query("UPDATE users SET password = '$password', reset_token = NULL, token_expiry = NULL WHERE reset_token = '$token'");
    $_SESSION['message'] = "Password has been reset successfully!";
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="form-box active">
            <form method="post">
                <h2>Reset Password</h2>
                <input type="password" name="password" placeholder="Enter New Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
                <button type="submit" name="reset_password">Reset Password</button>
            </form>
        </div>
    </div>
</body>
</html> 