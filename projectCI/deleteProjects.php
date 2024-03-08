<?php
require_once 'includes/connection.php';

if (isset($_GET['id'])) {
    $project_id = $_GET['id'];

    $sql = "DELETE FROM projects WHERE id = $project_id";
    $delete = mysqli_query($db, $sql);
}

header("Location: projects.php");
