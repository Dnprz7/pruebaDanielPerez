<?php
require_once 'includes/connection.php';
require_once 'includes/helpers.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user']['id']) && !isset($_SESSION['user']['role'])) {
    header("Location: login.php");
}

$user_id = $_SESSION['user']['id'];
$role = $_SESSION['user']['role'];

$projects = findProjects($db, $user_id, $role);

require_once 'includes/header.php';
?>

<div id='main'>
    <h1>Projects:</h1>
    <hr></br>
    <h3><a href='createProjects.php' class='projectLink'>Add a new Project</a></h3>

    <?php if (!empty($projects)) : ?>
        <?php while ($project = mysqli_fetch_assoc($projects)) : ?>
            <article class="projects">

                <h2><a href="project.php?id=<?= $project['id'] ?>"><?= $project['name'] ?></a></h2>

                <span class="date">Start Date: <?= date('d/m/Y', strtotime($project['start_date'])) ?></span>

                <p><?= substr($project['description'], 0, 100) . "..." ?></p>

                <a href="editProjects.php?id=<?= $project['id'] ?>" class="projectLink">Edit.</a>
                <a href="deleteProjects.php?id=<?= $project['id'] ?>" class="projectLink">Delete.</a>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p>You have not registered any projects so far...</p>
    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>