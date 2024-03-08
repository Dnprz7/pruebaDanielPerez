<?php
require_once 'includes/helpers.php';
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
</head>

<body id="login-body" class="form-body">
    <div id="loginForm" class="form-container">

        <?php if (isset($_SESSION['completed'])) : ?>
            <div class="alert alert-completed">
                <?= $_SESSION['completed'] ?>
            </div>
        <?php endif; ?>

        <h2>Login</h2>

        <?php if (isset($_SESSION['errorLogin'])) : ?>
            <div class="alert alerta-error">
                <?= $_SESSION['errorLogin']; ?>
            </div>
        <?php endif; ?>

        <form action="validateLogin.php" method="POST">

            <label for="email"></label>
            <input type="text" id="email" name="email" placeholder="Email">

            <label for="password"></label>
            <input type="password" id="password" name="password" placeholder="Password">

            <input type="submit" value="Login">
        </form>
        <p>Still don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
    <?php eraseErrors(); ?>
</body>

</html>