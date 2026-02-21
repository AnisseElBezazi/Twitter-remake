<?php
require_once __DIR__ . '/../config/database.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die('Non autorisé.');
}

$stmt = $pdo->prepare('SELECT role FROM users WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
if ($stmt->fetchColumn() !== 'admin') {
    die('Non autorisé.');
}

$movieId = $_GET['id'] ?? null;

if ($movieId) {
    $stmt = $pdo->prepare('SELECT poster_path FROM movies WHERE id = ?');
    $stmt->execute([$movieId]);
    $movie = $stmt->fetch();

    if ($movie) {
        $imagePath = '../assets/img/' . $movie['poster_path'];
        if (file_exists($imagePath) && is_file($imagePath)) {
            unlink($imagePath);
        }

        $pdo->prepare('DELETE comments FROM comments INNER JOIN posts ON comments.post_id = posts.id WHERE posts.movie_id = ?')->execute([$movieId]);
        $pdo->prepare('DELETE likes FROM likes INNER JOIN posts ON likes.post_id = posts.id WHERE posts.movie_id = ?')->execute([$movieId]);
        $pdo->prepare('DELETE FROM posts WHERE movie_id = ?')->execute([$movieId]);
        $pdo->prepare('DELETE FROM movies WHERE id = ?')->execute([$movieId]);
    }
}

header('Location: ../index.php');
exit();
