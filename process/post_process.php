<?php
require_once('../includes/security.php');
require_once('../includes/functions.php');
require_once('../config/database.php');
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../index.php");
    exit();
}

if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
    die("Erreur de sécurité : Jeton CSRF invalide ou expiré.");
}

if (!isset($_SESSION['user_id'])) {
    die("Erreur : Action non autorisée. Veuillez vous connecter.");
}

$content = trim($_POST['content']);
$movieId = !empty($_POST['movie_id']) ? (int)$_POST['movie_id'] : null;
$userId = $_SESSION['user_id'];

if (empty($content)) {
    die("Erreur : Le message ne peut pas être vide.");
}

try {
    $stmt = $pdo->prepare("INSERT INTO posts (user_id, movie_id, content) VALUES (:user_id, :movie_id, :content)");
    $stmt->execute([
        ':user_id' => $userId,
        ':movie_id' => $movieId,
        ':content' => $content
    ]);

    $redirect = $movieId ? "?movie_id=" . $movieId : "";
    header("Location: ../index.php" . $redirect);
    exit();

} catch (PDOException $e) {
    die("Erreur SQL : " . $e->getMessage());
}