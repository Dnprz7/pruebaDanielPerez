<?php
require_once 'includes/connection.php';
require_once 'includes/helpers.php';

$projectsMonth = projectsMonth($db);
$largerProjects = largerProjects($db);
$task_stats = taskStatistics($db);
?>

<?php require_once 'includes/header.php'; ?>

<div id="main">
    <h1>Statistics of all projects and tasks:</h1>
    <hr></br>


    <div class="chart-container">
        <h2>Projects per month:</h2>
        <canvas id="project-chart" project_data="<?php echo htmlentities(json_encode($projectsMonth)); ?>"></canvas>
    </div>

    <hr></br>
    <h2>Largest projects by number of tasks:</h2>
    <table id="largerProjects">
        <thead>
            <tr>
                <th>Project</th>
                <th>Tasks count</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($largerProjects as $project) : ?>
                <tr>
                    <td><?php echo $project['project_name']; ?></td>
                    <td><?php echo $project['task_count']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <hr></br>
    <h2>Tasks status in all projects:</h2>
    <table id="taskStatus">
        <thead>
            <tr>
                <th>Status</th>
                <th>Count</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Pending</td>
                <td><?php echo $task_stats['pending_count']; ?></td>
            </tr>
            <tr>
                <td>In Progress</td>
                <td><?php echo $task_stats['in_progress_count']; ?></td>
            </tr>
            <tr>
                <td>Completed</td>
                <td><?php echo $task_stats['completed_count']; ?></td>
            </tr>
        </tbody>
    </table>

    <form action="export.php" method="POST">
        <button type="submit" name="export_csv">Export to CSV</button>
    </form>

</div>

<?php require_once 'includes/footer.php'; ?>