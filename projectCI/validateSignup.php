<?php
if (isset($_POST)) {

    require_once 'includes/connection.php';
    require_once 'includes/helpers.php';

    if (!isset($_SESSION)) {
        session_start();
    }

    $name = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

    $errors = array();

    if (!empty($name) && !is_numeric($name) && !preg_match("/[0-9]/", $name)) {
        $name_valid = true;
    } else {
        $name_valid = false;
        $errors['name'] = "*Invalid Name";
    }

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_valid = true;
    } else {
        $email_valid = false;
        $errors['email'] = "*Invalid email";
    }

    if (emailExists($db, $email)) {
        $email_valid = false;
        $errors['email'] = "*Email already in use";
    }

    if (!empty($password)) {
        $password_valid = true;
    } else {
        $password_valid = false;
        $errors['password'] = "*Password empty";
    }

    $saveUser = false;

    if (count($errors) == 0) {
        $saveUser = true;

        $passwordEncripted = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

        $sql = "INSERT INTO users VALUES (null,'$name','$email','$passwordEncripted','regular_user');";
        $save = mysqli_query($db, $sql);


        if ($save) {
            $_SESSION['completed'] = "Registration completed!";
            header('Location: login.php');
        } else {
            $_SESSION['errors']['general'] = "Registration has failed";
            header('Location: signup.php');
        }
    } else {
        $_SESSION['errors'] = $errors;
        header('Location: signup.php');
    }
}
