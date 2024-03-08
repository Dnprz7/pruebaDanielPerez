<?php
require_once 'includes/connection.php';
require_once 'includes/helpers.php';

$actualTask = findTask($db, $_GET['id']);

if (isset($actualTask['id'])) {
    $task_id = $actualTask['id'];

    $sql = "DELETE FROM tasks WHERE id = $task_id";
    $delete = mysqli_query($db, $sql);
    header("Location: project.php?id=" . $actualTask['project_id']);
} else {
    header("Location: projects.php");
}
