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

$imagePath = null;

if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    $maxSize = 5 * 1024 * 1024; // 5 MB

    if (!in_array($_FILES['image']['type'], $allowedTypes)) {
        die("Erreur : Seuls les formats JPG, PNG et WEBP sont autorisés.");
    }

    if ($_FILES['image']['size'] > $maxSize) {
        die("Erreur : L'image ne doit pas dépasser 5 Mo.");
    }

    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $filename = uniqid('post_') . '.' . $extension;
    $destination = '../assets/upload/posts/' . $filename;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
        $imagePath = $filename;
    } else {
        die("Erreur lors de l'enregistrement de l'image.");
    }
}

try {
    $stmt = $pdo->prepare("INSERT INTO posts (user_id, movie_id, content, image_path) VALUES (:user_id, :movie_id, :content, :image_path)");
    $stmt->execute([
        ':user_id' => $userId,
        ':movie_id' => $movieId,
        ':content' => $content,
        ':image_path' => $imagePath
    ]);

    $redirect = $movieId ? "?movie_id=" . $movieId : "";
    header("Location: ../index.php" . $redirect);
    exit();
} catch (PDOException $e) {
    die("Erreur SQL : " . $e->getMessage());
}
