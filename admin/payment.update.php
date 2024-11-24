<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    include '../config.php';
    include '../includes/db.php';
    include '../includes/payment.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = isset($_POST['id']) ? trim($_POST['id']) : null;
        if (!empty($id)) {
            try {
                $db = new Database();
                $payment = new Payment($db);
                $payment->updateStatus($id);
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
