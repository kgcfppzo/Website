<?php
session_start(); // Start the session at the beginning
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        header('Location: ./dashboard.php');
    }else{
        header('Location: ./login.php');
    }
?>