<?php
session_start();

if (!isset($_SESSION['pseudo'])) {
    header('Location: login.php');
    exit();
} 
?>