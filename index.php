<?php
include './config.php';
include './includes/db.php';
include './includes/event.php';
include './includes/stat.php';
$statModel = new Stat($db);
$statModel->add('home');
$eventModel = new Event($db);
$availableEvent = $eventModel->getAvailableEvent();
$pageTitle = 'Homepage';
include './frontend/partials/header.html';
include './frontend/index.html';
?>
<?php include './frontend/partials/footer.html' ?>