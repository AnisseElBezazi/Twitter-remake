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
    die("Erreur lors de la mise à jour.");
}

$avatarDir = '../assets/upload/avatars/';
$bannerDir = '../assets/upload/banner/';
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
$maxSize = 2 * 1024 * 1024; // 2 Mo pour éviter de saturer le serveur (DDoS)


$handleUpload = function ($fileKey, $targetDir, $nameSuffix) use ($allowedExtensions, $maxSize, $pseudo) {
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {

        if ($_FILES[$fileKey]['size'] > $maxSize) return false;


        $ext = strtolower(pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExtensions)) return false;

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $_FILES[$fileKey]['tmp_name']);

        if (strpos($mimeType, 'image/') !== 0) return false;

        $finalName = $pseudo . $nameSuffix . '.' . $ext;
        if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $targetDir . $finalName)) {
            return $finalName;
        }
    }
    return false;
};

$newAvatar = $handleUpload('avatar', $avatarDir, '_avatar');
if ($newAvatar) {
    $stmt = $pdo->prepare("UPDATE users SET avatar = :avatar WHERE id = :id");
    $stmt->execute([':avatar' => $newAvatar, ':id' => $userId]);
    $_SESSION['avatar'] = $newAvatar;
}


$newBanner = $handleUpload('banner', $bannerDir, '_banner');
if ($newBanner) {
    $stmt = $pdo->prepare("UPDATE users SET banner = :banner WHERE id = :id");
    $stmt->execute([':banner' => $newBanner, ':id' => $userId]);
}

header("Location: ../profil.php");
exit();
