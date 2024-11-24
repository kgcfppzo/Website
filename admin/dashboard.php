<?php
session_start(); // Start the session at the beginning
    if(!isset($_SESSION['loggedin']) && !$_SESSION['loggedin'] == true){
        header('Location: ./login.php');
        die();
    }
    include '../config.php';
    include '../includes/db.php';
    include '../includes/stat.php';
    $statModel = new Stat($db);
    $stats = $statModel->getAll();
    include '../includes/event.php';
    $eventModel = new Event($db);
    $events = $eventModel->getAll();
    include '../includes/testimony.php';
    $testimonyModel = new Testimony($db);
    $testimonies = $testimonyModel->getAll();
    include '../includes/payment.php';
    $paymentModel = new Payment($db);
    $payments = $paymentModel->getAll();
    include '../includes/contact.php';
    $contactModel = new Contact($db);
    $contacts = $contactModel->getAll();
    include './dashboard.html';
?>
