<?php
include './config.php';
include './includes/db.php';
include './includes/event.php';
include './includes/stat.php';
$statModel = new Stat($db);
$statModel->add('about');
$eventModel = new Event($db);
$availableEvent = $eventModel->getAvailableEvent();
$pageTitle = 'About';
include './frontend/partials/header.html';
include './frontend/about.html';
?>
<?php include './frontend/partials/footer.html' ?>