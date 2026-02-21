<?php
require_once('../includes/security.php');
require_once('../config/database.php');
require_once('../includes/functions.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit();
}

if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
    die("Erreur de sécurité : Jeton CSRF invalide.");
}

$userId = $_SESSION['user_id'];
$postId = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
$content = trim($_POST['content'] ?? '');

if (empty($content) || $postId === 0) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}

try {
    $stmt = $pdo->prepare("INSERT INTO comments (user_id, post_id, content) VALUES (?, ?, ?)");
    $stmt->execute([$userId, $postId, $content]);
    header("Location: ../post.php?id=" . $postId . "&comment=success");
    exit();
} catch (PDOException $e) {
    die("Une erreur est survenue lors de l'envoi de votre commentaire.");
}
