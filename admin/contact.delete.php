<?php

// $rootPath = $_SERVER['DOCUMENT_ROOT'].'/Rccf-website
include '../config.php';
include '../includes/db.php';
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // $user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve and trim POST data
        $id = isset($_POST['id']) ? trim($_POST['id']) : null;

        // Validate required fields
        if (empty($id)) {
            die("Title is required.");
        }
        // Create the event
        try {
            $db = new Database();
            $event = new Event($db);
            $event->delete($id);
            echo "Event deleted successfully.";
            // Optionally, redirect or set session variables as needed
            // header('Location: ./dashboard.php');
        } catch (Exception $e) {
            echo "An error occurred while creating the event: " . $e->getMessage();
        }
    } else {
        echo "Invalid request method.";
    }

    $user = $_SESSION['user'];
    echo "Logged in as: " . $user;
} else {
    header('Location: ./login.php');
    exit();
}
?>
