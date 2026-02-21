<?php

$query = $pdo->query("SELECT * FROM movies ORDER BY created_at DESC");
$movies = $query->fetchAll(PDO::FETCH_ASSOC);

$movieId = isset($_GET['movie_id']) ? (int)$_GET['movie_id'] : null;
$currentUserId = $_SESSION['user_id'];

$sql = "
    SELECT p.*, u.pseudo, u.real_name, u.avatar, m.title as movie_name,
           (SELECT COUNT(*) FROM likes WHERE post_id = p.id) as like_count,
           (SELECT COUNT(*) FROM likes WHERE post_id = p.id AND user_id = :current_user_id) as user_liked,
           (SELECT COUNT(*) FROM comments WHERE post_id = p.id) as comment_count
    FROM posts p
    JOIN users u ON p.user_id = u.id
    LEFT JOIN movies m ON p.movie_id = m.id
";


if ($movieId) {
    $stmt = $pdo->prepare($sql . " WHERE p.movie_id = :movie_id ORDER BY p.created_at DESC");
    $stmt->execute([
        ':current_user_id' => $currentUserId,
        ':movie_id' => $movieId
    ]);
} else {
    $stmt = $pdo->prepare($sql . " ORDER BY p.created_at DESC");
    $stmt->execute([':current_user_id' => $currentUserId]);
}

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);


$currentMovieTitle = "Général";
if ($movieId) {
    $stmt_title = $pdo->prepare("SELECT title FROM movies WHERE id = ?");
    $stmt_title->execute([$movieId]);
    $current_movie = $stmt_title->fetch(PDO::FETCH_ASSOC);
    $currentMovieTitle = $current_movie ? "Salon : " . $current_movie['title'] : "Salon introuvable";
}
