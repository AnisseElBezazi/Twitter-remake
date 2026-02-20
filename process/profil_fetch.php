<?php
$pseudo = $_SESSION['pseudo'];


$stmt = $pdo->prepare('SELECT * FROM users WHERE pseudo = :pseudo');
$stmt->execute([':pseudo' => $pseudo]);
$user = $stmt->fetch();

$id = $user['id'];


$stmt_count = $pdo->prepare('SELECT COUNT(*) FROM posts WHERE user_id = :user_id');
$stmt_count->execute([':user_id' => $id]);
$nb_post = $stmt_count->fetchColumn();


$stmt_posts = $pdo->prepare('
    SELECT p.*, u.pseudo, u.real_name, u.avatar, m.title as movie_name 
    FROM posts p 
    JOIN users u ON p.user_id = u.id 
    LEFT JOIN movies m ON p.movie_id = m.id 
    WHERE p.user_id = :user_id 
    ORDER BY p.created_at DESC
');
$stmt_posts->execute([':user_id' => $id]);
$user_posts = $stmt_posts->fetchAll();

$pp = $user['avatar'];
$banner = $user['banner'];
$realName = $user['real_name'] ?? $pseudo;
$bio = $user['bio'] ?? "Vous n'avez pas de bio.";

$dateDb = $user['created_at'];
$date = new DateTime($dateDb);

$mois = [
    1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
    5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
    9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'
];
$numeroMois = (int)$date->format('m');
$annee = $date->format('Y');
$created = $mois[$numeroMois] . ' ' . $annee;
?>