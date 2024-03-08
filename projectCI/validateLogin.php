<?php
require_once 'includes/connection.php';
require_once 'includes/helpers.php';

if (isset($_POST)) {

    if (isset($_SESSION['errorLogin'])) {
        unset($_SESSION['errorLogin']);
    }

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $login = mysqli_query($db, $sql);

    if ($login && mysqli_num_rows($login) == 1) {
        $user = mysqli_fetch_assoc($login);

        $verify = password_verify($password, $user['password']);

        if ($verify) {
            $_SESSION['user'] = $user;
            header('Location: index.php');
        } else {
            $_SESSION['errorLogin'] = "*Invalid details";
            header('Location: login.php');
        }
    } else {
        $_SESSION['errorLogin'] = "*Invalid details";
        header('Location: login.php');
    }
}
