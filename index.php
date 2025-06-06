<?php
session_start();

$errors = [
    'login_error' => $_SESSION['login_error'] ?? "",
    'register_error' => $_SESSION['register_error'] ?? '',
];
$active_form = $_SESSION['active_form'] ?? 'login-form';

function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm)
{
    return $formName === $activeForm ? 'active' : '';
}

// Clear session variables after we've used them
session_unset();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Register Form with userr and Admin page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php if(isset($_SESSION['user_id'])): ?>
        <div class="logout-container">
            <a href="logout.php" class="logout-btn">Logout</a>
        </div>
        <?php endif; ?>
        <div class="form-box <?= isActiveForm('login-form', $active_form); ?>" id="login-form">
            <form action="login_register.php" method="post">
                <h2>Login</h2>
                <?= showError($errors['login_error']); ?>
                <input type="email" name ="email" placeholder="Enter Your Email" required>
                <input type="password" name ="password" placeholder="Enter Your Password" required>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account?<a href="#" onclick="showForm('register-form')">Register</a></p>
                <p><a href="#" onclick="showForm('forgot-form')">Forgot Password?</a></p>
            </form>
        </div>
        <div class="form-box <?= isActiveForm('register-form', $active_form); ?>"id="register-form">
            <form action="login_register.php" method="post">
                <h2>Register</h2>
                <?= showError($errors['register_error']); ?>
                <input type="text" name ="username" placeholder="Enter Your Name" required>
                <input type="email" name ="email" placeholder="Enter Your Email" required>
                <input type="password" name ="password" placeholder="Enter Your Password" required>
                <select name="role" required>
                    <option value="">--Select Role--</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit" name="register">Register</button>
                <p>Have an account?<a href="#" onclick="showForm('login-form')">Login</a></p>
            </form>
        </div>
        <div class="form-box" id="forgot-form">
            <form action="forgot_password.php" method="post">
                <h2>Reset Password</h2>
                <?php if(isset($_SESSION['message'])): ?>
                    <p class="success-message"><?= $_SESSION['message'] ?></p>
                    <?php if(isset($_SESSION['reset_link'])): ?>
                        <div class="reset-link-container">
                            <input type="text" value="<?= $_SESSION['reset_link'] ?>" readonly onclick="this.select();">
                            <p class="copy-message">Click to copy the link</p>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(isset($_SESSION['error'])): ?>
                    <p class="error-message"><?= $_SESSION['error'] ?></p>
                <?php endif; ?>
                <input type="email" name="email" placeholder="Enter Your Email" required>
                <button type="submit" name="reset">Generate Reset Link</button>
                <p><a href="#" onclick="showForm('login-form')">Back to Login</a></p>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>