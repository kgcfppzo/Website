<?php
// $stat = new Stat($db);
// $stat->add('sermon');
// $testimonyModel = new Testimony($db);
// $liveEvent = $Model->getLiveEvent();
$pageTitle = 'Testimony';
include './config.php';
include './includes/db.php';
include './includes/event.php';
include './includes/stat.php';
$statModel = new Stat($db);
$statModel->add('testimony');
$eventModel = new Event($db);
$availableEvent = $eventModel->getAvailableEvent();
include './includes/create-testimony.php';
include './frontend/partials/header.html';
include './frontend/testimony.html';
?>
<?php include './frontend/partials/footer.html' ?>