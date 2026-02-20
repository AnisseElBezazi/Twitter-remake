<?php
require_once('../includes/security.php');
require_once('../config/database.php');
require_once('../includes/functions.php');


if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}


$token = $_GET['csrf_token'] ?? '';
if (!verify_csrf_token($token)) {
    die("Erreur de sécurité CSRF");
}

if (isset($_GET['post_id'])) {
    $userId = $_SESSION['user_id'];
    $postId = (int)$_GET['post_id'];


    $stmt = $pdo->prepare("SELECT user_id FROM likes WHERE user_id = ? AND post_id = ?");
    $stmt->execute([$userId, $postId]);

    if ($stmt->fetch()) {
        $pdo->prepare("DELETE FROM likes WHERE user_id = ? AND post_id = ?")->execute([$userId, $postId]);
    } else {
        $pdo->prepare("INSERT INTO likes (user_id, post_id) VALUES (?, ?)")->execute([$userId, $postId]);
    }
}


header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
