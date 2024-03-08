<?php
function showErrors($errors, $field)
{
    $alert = '';
    if (isset($errors[$field]) && !empty($field)) {
        $alert = "<div class='alert errorAlert'>" . $errors[$field] . '</div>';
    }
    return $alert;
}

function eraseErrors()
{
    if (isset($_SESSION['errors'])) {
        $_SESSION['errors'] = null;
        unset($_SESSION['errors']);
    }

    if (isset($_SESSION['errorsProject'])) {
        $_SESSION['errorsProject'] = null;
        unset($_SESSION['errorsProject']);
    }

    if (isset($_SESSION['errorsTask'])) {
        $_SESSION['errorsTask'] = null;
        unset($_SESSION['errorsTask']);
    }

    if (isset($_SESSION['completed'])) {
        $_SESSION['completed'] = null;
        unset($_SESSION['completed']);
    }

    if (isset($_SESSION['errorLogin'])) {
        $_SESSION['errorLogin'] = null;
        unset($_SESSION['errorLogin']);
    }
}

function emailExists($connection, $email)
{
    $sql = "SELECT COUNT(*) as count FROM users WHERE email = '$email'";

    $result = mysqli_query($connection, $sql);

    if ($result) {
        $count = mysqli_fetch_assoc($result)['count'];
        return $count > 0;
    } else {
        return false;
    }
}

function findProject($connection,  $id)
{
    $sql = "SELECT * FROM projects WHERE id = $id";

    $project = mysqli_query($connection, $sql);

    $result = array();
    if ($project && mysqli_num_rows($project) > 0) {
        $result = mysqli_fetch_assoc($project);
    }

    return $result;
}


function findProjects($connection, $user_id = null, $role = null)
{
    if ($role === 'administrator') {
        $sql = "SELECT * FROM projects ORDER BY id ASC";
    } else {
        $sql = "SELECT * FROM projects WHERE user_id = $user_id ORDER BY id ASC";
    }

    $projects = mysqli_query($connection, $sql);

    $result = array();
    if ($projects && mysqli_num_rows($projects) > 0) {
        $result = $projects;
    }

    return $result;
}

function findTasks($connection, $id)
{
    $sql = "SELECT t.* , p.name AS 'projectName'"
        . " FROM tasks t"
        . " JOIN projects p ON t.project_id = p.id"
        . " WHERE p.id = $id"
        . " ORDER BY t.id DESC;";

    $tasks = mysqli_query($connection, $sql);

    $result = array();
    if ($tasks && mysqli_num_rows($tasks)  > 0) {
        $result = $tasks;
    }

    return $result;
}


function findTask($connection, $id)
{
    $sql = "SELECT * FROM tasks WHERE id = $id";

    $tasks = mysqli_query($connection, $sql);

    $result = array();
    if ($tasks && mysqli_num_rows($tasks)  > 0) {
        $result = mysqli_fetch_assoc($tasks);
    }

    return $result;
}

function projectsMonth($connection)
{
    $sql = "SELECT MONTHNAME(start_date) AS month, COUNT(*) AS project_count"
        . " FROM projects"
        . " WHERE YEAR(start_date) = YEAR(CURRENT_DATE())"
        . " GROUP BY MONTH(start_date)"
        . " ORDER BY MONTH(start_date)";

    $result = mysqli_query($connection, $sql);

    $project_data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $project_data[$row['month']] = $row['project_count'];
    }

    return $project_data;
}

function largerProjects($connection)
{
    $sql = "SELECT p.name AS project_name, COUNT(t.id) AS task_count"
        . " FROM projects p "
        . " JOIN tasks t ON p.id = t.project_id "
        . " GROUP BY p.id "
        . " ORDER BY task_count DESC";

    $result = mysqli_query($connection, $sql);

    $projects = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $projects[] = $row;
    }

    return $projects;
}

function taskStatistics($connection)
{
    $sql_pending = "SELECT COUNT(*) AS pending_count FROM tasks WHERE status = 'pending'";
    $sql_in_progress = "SELECT COUNT(*) AS in_progress_count FROM tasks WHERE status = 'in_progress'";
    $sql_completed = "SELECT COUNT(*) AS completed_count FROM tasks WHERE status = 'completed'";

    $result_pending = mysqli_query($connection, $sql_pending);
    $result_in_progress = mysqli_query($connection, $sql_in_progress);
    $result_completed = mysqli_query($connection, $sql_completed);


    $pending_count = mysqli_fetch_assoc($result_pending)['pending_count'];
    $in_progress_count = mysqli_fetch_assoc($result_in_progress)['in_progress_count'];
    $completed_count = mysqli_fetch_assoc($result_completed)['completed_count'];

    return [ //array assoc
        'pending_count' => $pending_count,
        'in_progress_count' => $in_progress_count,
        'completed_count' => $completed_count
    ];
}

function exporToCSV($connection)
{
    $sql = "SELECT"
        . " p.name AS 'Project name',"
        . " p.description AS 'Project Description',"
        . " p.start_date AS 'Project Start date',"
        . " t.name AS 'Task Name',"
        . " t.description AS 'Task Description',"
        . " t.due_date AS 'Task Due date',"
        . " t.status AS 'Task Status'"
        . " FROM projects p"
        . " LEFT JOIN tasks t ON p.id = t.project_id"
        . " ORDER BY p.id, t.id";


    $result = mysqli_query($connection, $sql);

    $csv_file = fopen('statistics.csv', 'w');

    fputcsv($csv_file, [
        'Project Name', 'Project Description', 'Project Start date', 'Task Name',
        'Task Description', 'Task Due date', 'Task Status',
    ]);

    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($csv_file, $row);
    }

    fclose($csv_file);

    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="statistics.csv"');
    readfile('statistics.csv');

    exit();
}
