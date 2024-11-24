<?php
include './config.php';
include './includes/db.php';
include './includes/pay.php';
include './includes/event.php';
include './includes/stat.php';
$statModel = new Stat($db);
$statModel->add('giving');
$eventModel = new Event($db);
$availableEvent = $eventModel->getAvailableEvent();
$pageTitle = 'Giving';
$pageScript = "https://js.stripe.com/v3/";
include './frontend/partials/header.html';
include './frontend/giving.html';
?>
<?php include './frontend/partials/footer.html' ?>