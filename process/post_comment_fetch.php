<?php

$postId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($postId === 0) {
    header("Location: index.php");
    exit();
}

$stmtPost = $pdo->prepare("
    SELECT p.*, u.pseudo, u.real_name, u.avatar, m.title as movie_name,
           (SELECT COUNT(*) FROM likes WHERE post_id = p.id) as like_count,
           (SELECT COUNT(*) FROM likes WHERE post_id = p.id AND user_id = :current_user) as user_liked,
           (SELECT COUNT(*) FROM comments WHERE post_id = p.id) as comment_count
    FROM posts p
    JOIN users u ON p.user_id = u.id
    LEFT JOIN movies m ON p.movie_id = m.id
    WHERE p.id = :post_id
");
$stmtPost->execute([':post_id' => $postId, ':current_user' => $_SESSION['user_id']]);
$post = $stmtPost->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    die("Post introuvable.");
}

$stmtComs = $pdo->prepare("
    SELECT c.*, u.pseudo, u.real_name, u.avatar 
    FROM comments c
    JOIN users u ON c.user_id = u.id
    WHERE c.post_id = ?
    ORDER BY c.created_at ASC
");
$stmtComs->execute([$postId]);
$comments = $stmtComs->fetchAll(PDO::FETCH_ASSOC);
