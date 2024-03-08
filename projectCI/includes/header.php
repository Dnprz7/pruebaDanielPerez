<?php
require_once 'connection.php';
require_once 'helpers.php';
if (!isset($_SESSION)) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- HEADER -->
    <header id="header">
        <nav id="headerMenu">
            <ul>
                <li id="loginLink">
                    <?php if (isset($_SESSION['user'])) : ?>
                        <div id="userGreeting">
                            <span>Welcome, <?= $_SESSION['user']['name']; ?>.</span>
                            <a href="logout.php">Logout</a>
                        </div>
                    <?php else : ?>
                        <div id="loginLink">
                            <a href="login.php">Log in</a>
                        </div>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>

    <div id='container'>
        <aside id='sidebar'>
            <nav id='menu'>
                <ul>
                    <li>
                        <img src="assets/img/cosmere.png" alt="logo">
                    </li>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="projects.php">Projects</a>
                    </li>
                    <li>
                        <a href="statistics.php">Statistics</a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main id='content'>