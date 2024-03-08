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
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
</head>

<body id="signup-body" class="form-body">
    <div id="signupForm" class="form-container">

        <?php if (isset($_SESSION['errors']['general'])) : ?>
            <div class="alert alert-error">
                <?= $_SESSION['errors']['general'] ?>
            </div>
        <?php endif; ?>

        <h2>Sign Up</h2>
        <form action="validateSignup.php" method="POST">


            <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'name') : ''; ?>
            <label for="name"></label>
            <input type="text" id="name" name="name" placeholder="Name">


            <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'email') : ''; ?>
            <label for="email"></label>
            <input type="email" id="email" name="email" placeholder="Email">


            <?php echo isset($_SESSION['errors']) ? showErrors($_SESSION['errors'], 'password') : ''; ?>
            <label for="password"></label>
            <input type="password" id="password" name="password" placeholder="Password">

            <input type="submit" value="Sign Up">
        </form>
        <p>Already have an account? <a href="login.php">Log in</a></p>
    </div>
    <?php eraseErrors(); ?>
</body>

</html>