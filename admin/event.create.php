<?php
include '../config.php';
include '../includes/db.php';
include '../includes/event.php';
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = isset($_POST['title']) ? trim($_POST['title']) : null;
        $description = isset($_POST['description']) ? trim($_POST['description']) : null;
        $datetime = isset($_POST['datetime']) ? trim($_POST['datetime']) : null;
        $location = isset($_POST['location']) ? trim($_POST['location']) : null;
        $lifecycle = 'upcoming';

        $targetDir = "../storage/events/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $image = null;
        if (isset($_FILES['image'])) {
            $file = $_FILES['image'];
            include '../includes/create-file.php';
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            $image = createFilePath('events/', $file, $allowedTypes);
        }

        if (!empty($title) || !empty($description) || !empty($datetime) || !empty($location) || !empty($image)) {
            $eventDateTime = DateTime::createFromFormat('Y-m-d\TH:i', $datetime);
            if ($eventDateTime) {
                $formattedDate = $eventDateTime->format('Y-m-d H:i:s');
            }
            try {
                $eventModel = new Event($db);
                $eventModel->update(3, $title, $description, $location, $formattedDate, $image, null, $lifecycle);
                header('Location: ./dashboard.php');
            } catch (Exception $e) {
                die();
            }
        }
        
    }
} else {
    header('Location: ./login.php');
    exit();
}
?>
