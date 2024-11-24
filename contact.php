<?php
include './config.php';
include './includes/db.php';
include './includes/event.php';
include './includes/stat.php';
$statModel = new Stat($db);
$statModel->add('contact');
$eventModel = new Event($db);
$availableEvent = $eventModel->getAvailableEvent();
include './includes/create-contact.php';
$pageTitle = 'Contact';
include './frontend/partials/header.html';
include './frontend/contact.html';
?>
<?php include './frontend/partials/footer.html' ?>