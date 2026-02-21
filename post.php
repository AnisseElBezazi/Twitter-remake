<?php
require_once('./includes/security.php');
require_once('./config/database.php');
require_once('./includes/functions.php');
require_once './process/data_fetch.php';
require_once './process/profil_fetch.php';
require_once './process/formatage_affichage.php';
require_once './process/post_comment_fetch.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post de <?= htmlspecialchars($post['pseudo']) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="body">

    <?php require './includes/header.php'; ?>

    <main class="milieu-page">
        <div class="top-profil">
            <a href="index.php" class="back-button">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 11H7.83L13.42 5.41L12 4L4 12L12 20L13.41 18.59L7.83 13H20V11Z" fill="white" />
                </svg>
            </a>
            <div class="user-info-top">
                <h3>Post</h3>
            </div>
        </div>

        <section class="posts">
            <div class="post">
                <div class="left-post">
                    <div class="pp">
                        <img src="assets/upload/avatars/<?= htmlspecialchars($post['avatar']) ?>" alt="avatar">
                    </div>
                </div>
                <div class="right-post">
                    <div class="pseudo">
                        <p class="name"><?= htmlspecialchars($post['real_name']) ?></p>
                        <p class="real-name">@<?= htmlspecialchars($post['pseudo']) ?></p>
                        <p class="time">. Salon : <?= htmlspecialchars($post['movie_name'] ?? 'Général') ?></p>
                    </div>
                    <div class="bottom-post">
                        <p class="message" style="font-size: 1.2rem;">
                            <?= nl2br(htmlspecialchars($post['content'])) ?>
                        </p>
                        <?php if (!empty($post['image_path'])): ?>
                            <div class="image-post">
                                <img src="assets/upload/posts/<?= htmlspecialchars($post['image_path']) ?>" />
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <form class="post-form" action="./process/comment_process.php" method="POST">
            <input type="hidden" name="csrf_token" value="<?= generate_csrf_token(); ?>">
            <input type="hidden" name="post_id" value="<?= $postId ?>">

            <div class="top-form">
                <div class="pp">
                    <img class="avatar" src="assets/upload/avatars/<?= htmlspecialchars($pp) ?>">
                </div>
                <textarea class="input-post" name="content" placeholder="Postez votre réponse" required></textarea>
            </div>
            <div class="bottom-form">
                <div></div> <button type="submit" class="primary-button">Répondre</button>
            </div>
        </form>

        <section class="posts">
            <?php foreach ($comments as $com): ?>
                <div class="post comment-item">
                    <div class="left-post">
                        <div class="pp">
                            <img src="assets/upload/avatars/<?= htmlspecialchars($com['avatar']) ?>" alt="avatar">
                        </div>
                    </div>
                    <div class="right-post">
                        <div class="pseudo">
                            <p class="name"><?= htmlspecialchars($com['real_name']) ?></p>
                            <p class="real-name">@<?= htmlspecialchars($com['pseudo']) ?></p>
                        </div>
                        <div class="bottom-post">
                            <p class="message"><?= nl2br(htmlspecialchars($com['content'])) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </main>

    <?php require './includes/nav-right.php'; ?>
</body>

</html>