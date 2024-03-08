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
    <h1>Create a new Task:</h1>
    <p>
        Here you can add a new Task for you project...
    </p>
    <br />
    <form action="saveTask.php" method="POST">

        <input type="hidden" name="id" value="<?= $actualProject['id'] ?>">

        <?php echo isset($_SESSION['errorsTask']) ? showErrors($_SESSION['errorsTask'], 'name') : ''; ?>
        <label for="name">Name:</label>
        <input type="text" name="name" />

        <?php echo isset($_SESSION['errorsTask']) ? showErrors($_SESSION['errorsTask'], 'description') : ''; ?>
        <label for="description">Description:</label>
        <textarea name="description"></textarea>

        <?php echo isset($_SESSION['errorsTask']) ? showErrors($_SESSION['errorsTask'], 'date') : ''; ?>
        <label for="date">Due Date:</label>
        <input type="date" name="date" id="date">

        <label for="status">Status:</label>
        <select name="status" id="status">
            <option value="pending">Pending</option>
            <option value="in_progress">In Progress</option>
            <option value="completed">Completed</option>
        </select>

        <input type="submit" value="Save" />
    </form>
    <?php eraseErrors(); ?>
</div>

<?php require_once 'includes/footer.php'; ?>