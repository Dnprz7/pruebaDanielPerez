<?php
require_once 'includes/connection.php';
require_once 'includes/helpers.php';

if (!isset($_GET['id'])) {
    header("Location: projects.php");
}

$actualProject = findProject($db, $_GET['id']);
if (!isset($actualProject['id'])) {
    header("Location: projects.php");
}

$tasks = findTasks($db, $_GET['id']);

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user']['id']) && !isset($_SESSION['user']['role'])) {
    header("Location: login.php");
}

require_once 'includes/header.php';
?>

<div id="main">

    <h1><?= $actualProject['name'] ?>:</h1>

    <span class="date">Start Date: <?= date('d/m/Y', strtotime($actualProject['start_date'])) ?></span>
    <p><?= $actualProject['description'] ?></p>
    <a href="editProjects.php?id=<?= $actualProject['id'] ?>" class="projectLink">Edit.</a>
    <a href="deleteProjects.php?id=<?= $actualProject['id'] ?>" class="projectLink">Delete.</a>

    <br><br>
    <hr>
    <br>
    <h1>Tasks:</h1>

    <h3><a href='createTasks.php?id=<?= $actualProject['id'] ?>' class='projectLink'>Add a new Task</a></h3>

    <?php if (!empty($tasks)) : ?>
        <?php while ($task = mysqli_fetch_assoc($tasks)) : ?>
            <article class="projects">

                <h2><?= $task['name'] ?></h2>

                <p>Status:
                    <?php if ($task['status'] == 'pending') : ?>
                        <span class="status-orange">Pending.</span><br>
                    <?php elseif ($task['status'] == 'in_progress') :  ?>
                        <span class="status-yellow">In Progress.</span><br>
                    <?php elseif ($task['status'] == 'completed') :  ?>
                        <span class="status-green">Completed.</span><br>
                    <?php endif;  ?>
                </p>

                <span class="date">Due Date: <?= date('d/m/Y', strtotime($task['due_date'])) ?></span>

                <p><?= substr($task['description'], 0, 100) . "..." ?></p>

                <a href="editTask.php?id=<?= $task['id'] ?>" class="projectLink">Edit.</a>
                <a href="deleteTask.php?id=<?= $task['id'] ?>" class="projectLink">Delete.</a>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p>You have not registered any tasks so far..</p>
    <?php endif; ?>

</div>

<?php require_once 'includes/footer.php'; ?>