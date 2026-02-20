<?php
require_once('../includes/security.php');
require_once('../config/database.php');
require_once('../includes/functions.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../profil.php");
    exit();
}

if (!isset($_POST['csrf_token']) || !verify_csrf_token($_POST['csrf_token'])) {
    die("Erreur de sécurité : Jeton CSRF invalide.");
}

$userId = $_SESSION['user_id'];
$pseudo = $_SESSION['pseudo'];
$bio = trim($_POST['bio'] ?? '');
$realName = trim($_POST['real_name'] ?? '');

try {
    $stmt = $pdo->prepare("UPDATE users SET bio = :bio, real_name = :real_name WHERE id = :id");
    $stmt->execute([
        ':bio' => $bio, 
        ':real_name' => $realName, 
        ':id' => $userId
    ]);
} catch (PDOException $e) {
    die("Erreur SQL lors de la mise à jour des infos : " . $e->getMessage());
}

$avatarDir = '../assets/upload/avatars/';
$bannerDir = '../assets/upload/banner/';

if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $avatarName = $pseudo . '_avatar.' . $ext;
    
    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $avatarDir . $avatarName)) {
        $stmt = $pdo->prepare("UPDATE users SET avatar = :avatar WHERE id = :id");
        $stmt->execute([':avatar' => $avatarName, ':id' => $userId]);
        $_SESSION['avatar'] = $avatarName;
    }
}

if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['banner']['name'], PATHINFO_EXTENSION);
    $bannerName = $pseudo . '_banner.' . $ext;
    
    if (move_uploaded_file($_FILES['banner']['tmp_name'], $bannerDir . $bannerName)) {
        $stmt = $pdo->prepare("UPDATE users SET banner = :banner WHERE id = :id");
        $stmt->execute([':banner' => $bannerName, ':id' => $userId]);
    }
}

header("Location: ../profil.php");
exit();