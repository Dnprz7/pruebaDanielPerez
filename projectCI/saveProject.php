<?php

if (isset($_POST)) {

    require_once 'includes/connection.php';

    $name = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name']) : false;
    $description = isset($_POST['description']) ? mysqli_real_escape_string($db, $_POST['description']) : false;
    $start_date = isset($_POST['date']) ? date('Y-m-d', strtotime($_POST['date'])) : false;
    $user_id = isset($_POST['user_id']) ? mysqli_real_escape_string($db, $_POST['user_id']) : false;

    $errors = array();

    if (empty($name)) {
        $errors['name'] = '*Invalid Name';
    }

    if (empty($description)) {
        $errors['description'] = '*Invalid Description';
    }

    if (empty($start_date) || strtotime($start_date) < strtotime('2020-01-01')) {
        $errors['date'] = '*Invalid Date';
    }

    if (empty($user_id)) {
        $errors['description'] = '*Unexpected error';
    }


    if (count($errors) == 0) {
        if (isset($_GET['edit'])) {
            $project_id = $_GET['edit'];

            $sql = "UPDATE projects SET name='$name', description='$description', start_date='$start_date' " .
                "WHERE id = $project_id";

            $save = mysqli_query($db, $sql);
            header("Location: project.php?id=" . $_GET['edit']);
        } else {
            $sql = "INSERT INTO projects VALUES(null,'$name', '$description', '$start_date','$user_id');";

            $save = mysqli_query($db, $sql);
            header("Location: projects.php");
        }
    } else {
        $_SESSION["errorsProject"] = $errors;

        if (isset($_GET['edit'])) {
            header("Location: editProjects.php?id=" . $_GET['edit']);
        } else {
            header("Location: createProjects.php");
        }
    }
}
