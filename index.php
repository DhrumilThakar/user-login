<?php
session_start();

$errors = [
    'login_error' => $_SESSION['login_error'] ?? "",
    'register_error' => $_SESSION['register_error'] ?? '',
];
$active_form = $_SESSION['active_form'] ?? 'login-form';
session_unset();

function showError($error) {
    return !empty($error) ? "<p class='error -message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm)
{
    return $formName === $activeForm ? 'active' : '';
}
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
        <div class="form-box <?= isActiveForm('login',$activeForm); ?> "id="login-form">
            <form action="login_register.php" method="post">
                <h2>Login</h2>
                <?= showError($errors['login_error']); ?>
                <input type="email" name ="email" placeholder="Enter Your Email" required>
                <input type="password" name ="password" placeholder="Enter Your Password" required>
                <button type="submit" name="login">Login</button>
                <p>Don't have an account?<a href="#" onclick="showForm('register-form')">Register</a></p>
            </form>
        </div>
        <div class="form-box <?= isActiveForm('register',$activeForm); ?>"id="register-form">
            <form action="login_register.php" method="post">
                <h2>Register</h2>
                <?= showError($errors['register_error']); ?>
                <input type="text" name ="username" placeholder="Enter Your Name" required>
                <input type="email" name ="email" placeholder="Enter Your Email" required>
                <input type="password" name ="password" placeholder="Enter Your Password" required>
                <select name="role" required>
                    <option value="">--Select Role--</option>
                    <option value="">User</option>
                    <option value="">Admin</option>
                </select>
                <button type="submit" name="register">Register</button>
                <p>Have an account?<a href="#" onclick="showForm('login-form')">Login</a></p>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>