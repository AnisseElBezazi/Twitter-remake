<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['pseudo'])) {
    header('Location: ../login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
        die("Erreur de sécurité : Jeton CSRF invalide.");
    }
}

function is_admin($pdo, $user_id)
{
    $stmt = $pdo->prepare('SELECT role FROM users WHERE id = ?');
    $stmt->execute([$user_id]);
    return $stmt->fetchColumn() === 'admin';
}

if (!is_admin($pdo, $_SESSION['user_id'])) {
    http_response_code(403);
    exit('Non autorisé.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $poster = $_FILES['poster'] ?? null;

    if (empty($title) || !$poster || $poster['error'] !== UPLOAD_ERR_OK) {
        die('Erreur : Données invalides.');
    }

    $ext = strtolower(pathinfo($poster['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'avif'])) {
        die('Erreur : Format non autorisé.');
    }

    // uniqid c pour générer un nom de fichier unique
    $fileName = uniqid() . '.' . $ext;
    if (move_uploaded_file($poster['tmp_name'], '../assets/img/' . $fileName)) {
        $stmt = $pdo->prepare('INSERT INTO movies (title, poster_path) VALUES (?, ?)');
        $stmt->execute([$title, $fileName]);
    }

    header('Location: ../index.php');
    exit();
}
