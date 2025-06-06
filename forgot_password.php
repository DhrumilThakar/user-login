<?php
session_start();
require_once 'config.php';

if (isset($_POST['reset'])) {
    $email = $conn->real_escape_string($_POST['email']);  // sanitize input
    
    // Check if email exists
    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($result->num_rows > 0) {
        // Generate a unique token
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        
        // Store token in database
        $update = $conn->query("UPDATE users SET reset_token='$token', reset_token_expiry='$expiry' WHERE email='$email'");
        
        if ($update) {
            $reset_link = "http://" . $_SERVER['HTTP_HOST'] . "/full_stack/reset_password.php?token=" . $token;
            $_SESSION['reset_link'] = $reset_link;
            $_SESSION['message'] = "Here is your password reset link. Please copy and use it to reset your password:";
            $_SESSION['active_form'] = 'forgot-form';
        } else {
            $_SESSION['error'] = "Failed to generate reset link. Error: " . $conn->error;
            $_SESSION['active_form'] = 'forgot-form';
        }
    } else {
        $_SESSION['error'] = "Email not found!";
        $_SESSION['active_form'] = 'forgot-form';
    }
    
    header("Location: index.php");
    exit();
}
?>