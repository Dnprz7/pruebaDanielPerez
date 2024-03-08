<?php

if (isset($_POST)) {

    require_once 'includes/connection.php';

    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION['user']['id']) && !isset($_SESSION['user']['role'])) {
        header("Location: login.php");
    }

    $name = isset($_POST['name']) ? mysqli_real_escape_string($db, $_POST['name']) : false;
    $description = isset($_POST['description']) ? mysqli_real_escape_string($db, $_POST['description']) : false;
    $due_date = isset($_POST['date']) ? date('Y-m-d', strtotime($_POST['date'])) : false;

    $statusOptions = ['pending', 'in_progress', 'completed'];
    $status = isset($_POST['status']) && in_array($_POST['status'], $statusOptions) ? $_POST['status'] : false;

    $project_id = isset($_POST['id']) ? mysqli_real_escape_string($db, $_POST['id']) : false;

    $errors = array();

    if (empty($name)) {
        $errors['name'] = '*Invalid Name';
    }

    if (empty($description)) {
        $errors['description'] = '*Invalid Description';
    }

    if (empty($due_date) || strtotime($due_date) < strtotime('2010-01-01')) {
        $errors['date'] = '*Invalid Date';
    }

    if (empty($status) || !$status) {
        $errors['status'] = '*Invalid Status';
    }

    if (empty($project_id)) {
        $errors['id'] = '*Invalid location';
    }

    if (count($errors) == 0) {
        if (isset($_GET['edit'])) {
            $task_id = $_GET['edit'];

            $sql = "UPDATE tasks SET name='$name', description='$description', due_date='$due_date', status='$status'" .
                "WHERE id = $task_id";
        } else {
            $sql = "INSERT INTO tasks VALUES(null,$project_id,'$name','$description', '$due_date','$status');";
        }

        $save = mysqli_query($db, $sql);
        header("Location: project.php?id=" . $project_id);
    } else {
        $_SESSION["errorsTask"] = $errors;

        if (isset($_GET['edit'])) {
            header("Location: editTask.php?id=" . $_GET['edit']);
        } else {
            header("Location: createTasks.php?id=" . $project_id);
        }
    }
} else {
    $_SESSION["errorsTask"] = $errors;
    header("Location:projects.php");
}
