<?php
require_once 'includes/connection.php';
require_once 'includes/helpers.php';

if (isset($_POST['export_csv'])) {
    exporToCSV($db);
}
