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
$bio = trim($_POST['bio'] ?? '');
$realName = trim($_POST['real_name'] ?? '');

$stmt_old = $pdo->prepare("SELECT avatar, banner FROM users WHERE id = :id");
$stmt_old->execute([':id' => $userId]);
$oldFiles = $stmt_old->fetch();

try {
    $stmt = $pdo->prepare("UPDATE users SET bio = :bio, real_name = :real_name WHERE id = :id");
    $stmt->execute([
        ':bio' => $bio,
        ':real_name' => $realName,
        ':id' => $userId
    ]);
} catch (PDOException $e) {
    die("Erreur lors de la mise à jour des informations.");
}

$avatarDir = '../assets/upload/avatars/';
$bannerDir = '../assets/upload/banner/';
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$maxSize = 2 * 1024 * 1024;

$handleUpload = function ($fileKey, $targetDir, $prefix) use ($allowedExtensions, $maxSize, $userId) {
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
        if ($_FILES[$fileKey]['size'] > $maxSize) return false;

        $ext = strtolower(pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $allowedExtensions)) return false;

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $_FILES[$fileKey]['tmp_name']);


        if (strpos($mimeType, 'image/') !== 0) return false;


        $finalName = $userId . '_' . $prefix . '_' . time() . '.' . $ext;

        if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $targetDir . $finalName)) {
            return $finalName;
        }
    }
    return false;
};

$newAvatar = $handleUpload('avatar', $avatarDir, 'avatar');
if ($newAvatar) {
    $stmt = $pdo->prepare("UPDATE users SET avatar = :avatar WHERE id = :id");
    $stmt->execute([':avatar' => $newAvatar, ':id' => $userId]);
    $_SESSION['avatar'] = $newAvatar;

    if (!empty($oldFiles['avatar']) && $oldFiles['avatar'] !== 'default.png') {
        $oldPath = $avatarDir . $oldFiles['avatar'];
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
    }
}

$newBanner = $handleUpload('banner', $bannerDir, 'banner');
if ($newBanner) {
    $stmt = $pdo->prepare("UPDATE users SET banner = :banner WHERE id = :id");
    $stmt->execute([':banner' => $newBanner, ':id' => $userId]);


    if (!empty($oldFiles['banner']) && $oldFiles['banner'] !== 'default_banner.png') {
        $oldPath = $bannerDir . $oldFiles['banner'];
        if (file_exists($oldPath)) {
            unlink($oldPath);
        }
    }
}

header("Location: ../profil.php");
exit();
