<?php
$query = $pdo->query("SELECT * FROM movies ORDER BY created_at DESC");
$movies = $query->fetchAll(PDO::FETCH_ASSOC);
$movieId = isset($_GET['movie_id']) ? (int)$_GET['movie_id'] : null;

if ($movieId) {
    $stmt = $pdo->prepare("
        SELECT p.*, u.pseudo, u.avatar, m.title as movie_name 
        FROM posts p
        JOIN users u ON p.user_id = u.id
        LEFT JOIN movies m ON p.movie_id = m.id
        WHERE p.movie_id = ?
        ORDER BY p.created_at DESC
    ");
    $stmt->execute([$movieId]);
} else {
    
    $stmt = $pdo->query("
        SELECT p.*, u.pseudo, u.avatar, m.title as movie_name 
        FROM posts p
        JOIN users u ON p.user_id = u.id
        LEFT JOIN movies m ON p.movie_id = m.id
        ORDER BY p.created_at DESC
    ");
}
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>