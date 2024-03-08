<?php require_once 'includes/header.php'; ?>

<?php if (isset($_SESSION['user'])) : ?>
    <h1>Welcome, <?= $_SESSION['user']['name']; ?>.</h1>
    <br />
    <hr />
    </br />
    <br />
    <p>Here you have a page where you can create and edit projects, you can create tasks
        edit them and assign them a status.
    </p>
    </br>
    <p>Feel free to browse through the options and don't forget to go through the stats field.</p>
<?php else : ?>
    <h1>Welcome.</h1>
    <br />
    <hr />
    </br />
    <br />
    <p>We invite you to register in our page to use this site, where you can create and edit projects,
        create tasks, edit them and assign them a status.
    </p>
    </br>
    <p>Feel free to browse through the options and don't forget to go through the stats field.</p>
<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>