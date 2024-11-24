<?php
include './config.php';
include './includes/db.php';
include './includes/event.php';
include './includes/stat.php';
$stat = new Stat($db);
$stat->add('sermon');
$eventModel = new Event($db);
$availableEvent = $eventModel->getAvailableEvent();
$pageTitle = 'Sermon';
include './frontend/partials/header.html';
include './frontend/sermons.html';
include './frontend/partials/upcoming-event.html';
?>
<?php include './frontend/partials/footer.html' ?>