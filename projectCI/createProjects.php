<?php
require_once 'includes/connection.php';
require_once 'includes/helpers.php';

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['user']['id']) && !isset($_SESSION['user']['role'])) {
    header("Location: login.php");
}

require_once 'includes/header.php';
?>

<div id="main">
    <h1>Create a new project:</h1>
    <p>
        Here you can add a new project...
    </p>
    <br />
    <form action="saveProject.php" method="POST">

        <?php echo isset($_SESSION['errorsProject']) ? showErrors($_SESSION['errorsProject'], 'name') : ''; ?>
        <label for="name">Name:</label>
        <input type="text" name="name" />

        <?php echo isset($_SESSION['errorsProject']) ? showErrors($_SESSION['errorsProject'], 'description') : ''; ?>
        <label for="description">Description:</label>
        <textarea name="description"></textarea>

        <label for="date">Start Date:</label>
        <input type="date" name="date" id="date">

        <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id']; ?>">

        <input type="submit" value="Save" />
    </form>
    <?php eraseErrors(); ?>
</div>

<?php require_once 'includes/footer.php'; ?>