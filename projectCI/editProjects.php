<?php
require_once 'includes/connection.php';
require_once 'includes/helpers.php';

$actualProject = findProject($db, $_GET['id']);

if (!isset($actualProject['id'])) {
    header("Location: projects.php");
}

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user']['id']) && !isset($_SESSION['user']['role'])) {
    header("Location: login.php");
}
require_once 'includes/header.php';
?>

<div id="main">
    <h1>Edit Project:</h1>
    <p>
        Edit your project: <?= $actualProject['name'] ?>
    </p>
    <br />
    <form action="saveProject.php?edit=<?= $actualProject['id'] ?>" method="POST">

        <?php echo isset($_SESSION['errorsProject']) ? showErrors($_SESSION['errorsProject'], 'name') : ''; ?>
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?= $actualProject['name'] ?>" />


        <?php echo isset($_SESSION['errorsProject']) ? showErrors($_SESSION['errorsProject'], 'description') : ''; ?>
        <label for="description">Description:</label>
        <textarea name="description"><?= $actualProject['description'] ?></textarea>


        <label for="date">Start Date:</label>
        <input type="date" name="date" id="date" value="<?= $actualProject['start_date'] ?>">

        <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id']; ?>">

        <input type="submit" value="Save" />
    </form>
    <?php eraseErrors(); ?>
</div>

<?php require_once 'includes/footer.php'; ?>