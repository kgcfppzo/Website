<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? trim($_POST['id']) : null;
        if (!empty($id)) {
            try {
                include '../config.php';
                include '../includes/db.php';
                include '../includes/testimony.php';
                $testimonyModel = new Testimony($db);
                $testimonyModel->show($id);
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
