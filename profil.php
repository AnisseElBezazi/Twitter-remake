<?php
require_once('./includes/security.php');
require_once('./includes/functions.php');
require_once './config/database.php';
require_once './process/data_fetch.php';
require_once './process/profil_fetch.php';
require_once './process/formatage_affichage.php';
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Profil de <?= htmlspecialchars($realName) ?></title>
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
                <h3><?= htmlspecialchars($realName) ?></h3>
                <p><?= $nb_post ?> posts</p>
            </div>
        </div>

        <div class="hero-profil">
            <img class="banner" src="assets/upload/banner/<?= htmlspecialchars($banner) ?>">
            <div class="avatar-container">
                <img class="avatar" src="assets/upload/avatars/<?= htmlspecialchars($pp) ?>">
            </div>
        </div>

        <div class="actions-profil">
            <button class="edit-button" onclick="openEditModal()">Éditer profil</button>
        </div>

        <div class="details-profil">
            <h2 class="name"><?= htmlspecialchars($realName) ?></h2>
            <p class="pseudo">@<?= htmlspecialchars($pseudo) ?></p>
            <p class="bio"><?= htmlspecialchars($bio) ?></p>


        </div>

        <div class="tabs-profil">
            <div class="tab active" onclick="switchTab('posts')">Posts</div>
            <div class="tab" onclick="switchTab('likes')">J'aime</div>
        </div>

        <section id="posts-section" class="posts">
            <?php if (!empty($user_posts)): ?>
                <?php foreach ($user_posts as $post): ?>
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
                                <p class="message">
                                    <?= nl2br(htmlspecialchars($post['content'])) ?>
                                </p>
                                <?php if (!empty($post['image_path'])): ?>
                                    <div class="image-post">
                                        <img src="assets/upload/posts/<?= htmlspecialchars($post['image_path']) ?>" />
                                    </div>
                                <?php endif; ?>
                                <div class="align-button">
                                    <div class="comment">
                                        <svg width="16" height="16" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1.99169 15.3417C2.13873 15.7126 2.17147 16.119 2.08569 16.5087L1.02069 19.7987C0.986375 19.9655 0.995248 20.1384 1.04647 20.3008C1.09769 20.4633 1.18955 20.61 1.31336 20.727C1.43716 20.844 1.5888 20.9274 1.75389 20.9693C1.91898 21.0113 2.09205 21.0104 2.25669 20.9667L5.66969 19.9687C6.03741 19.8958 6.41822 19.9276 6.76869 20.0607C8.90408 21.0579 11.3231 21.2689 13.5988 20.6564C15.8746 20.0439 17.861 18.6473 19.2074 16.7131C20.5538 14.7788 21.1738 12.4311 20.958 10.0842C20.7422 7.73738 19.7044 5.54216 18.0278 3.88589C16.3511 2.22962 14.1434 1.21873 11.7941 1.03159C9.44475 0.844449 7.10483 1.49308 5.18713 2.86303C3.26944 4.23299 1.89722 6.23624 1.31258 8.51933C0.727946 10.8024 0.96846 13.2186 1.99169 15.3417Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <p>0</p>
                                    </div>
                                    <a href="./process/like_process.php?post_id=<?= $post['id'] ?>&csrf_token=<?= $_SESSION['csrf_token'] ?>" class="like-link">
                                        <svg width="15" height="14" viewBox="0 0 20 19"
                                            fill="<?= (isset($post['user_liked']) && $post['user_liked']) ? '#e0245e' : 'none' ?>"
                                            style="color: <?= (isset($post['user_liked']) && $post['user_liked']) ? '#e0245e' : 'currentColor' ?>;">
                                            <path d="M17.513 9.58341L10.013 17.0114L2.513 9.58341C2.0183 9.10202 1.62864 8.52342 1.36854 7.88404C1.10845 7.24466 0.983558 6.55836 1.00173 5.86834C1.01991 5.17832 1.18076 4.49954 1.47415 3.87474C1.76755 3.24994 2.18713 2.69266 2.70648 2.23799C3.22583 1.78331 3.8337 1.4411 4.49181 1.23289C5.14991 1.02468 5.844 0.954991 6.53036 1.02821C7.21673 1.10143 7.8805 1.31596 8.47987 1.65831C9.07925 2.00066 9.60124 2.46341 10.013 3.01741C10.4265 2.46743 10.9491 2.00873 11.5481 1.67001C12.1471 1.3313 12.8095 1.11986 13.4939 1.04893C14.1784 0.977998 14.8701 1.04911 15.5258 1.2578C16.1815 1.46649 16.787 1.80828 17.3045 2.26177C17.8221 2.71526 18.2404 3.27069 18.5334 3.8933C18.8264 4.51591 18.9877 5.19229 19.0073 5.88012C19.0269 6.56794 18.9043 7.2524 18.6471 7.89066C18.39 8.52891 18.0039 9.10723 17.513 9.58941"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span><?= $post['like_count'] ?? 0 ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="msg-vide">Aucun post pour le moment.</p>
            <?php endif; ?>
        </section>
        <section id="likes-section" class="posts" style="display: none;">
            <?php if (!empty($liked_posts)): ?>
                <?php foreach ($liked_posts as $post): ?>
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
                                <p class="message"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                                <div class="align-button">
                                    <div class="comment">
                                        <svg width="16" height="16" viewBox="0 0 22 22" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M1.99169 15.3417C2.13873 15.7126 2.17147 16.119 2.08569 16.5087L1.02069 19.7987C0.986375 19.9655 0.995248 20.1384 1.04647 20.3008C1.09769 20.4633 1.18955 20.61 1.31336 20.727C1.43716 20.844 1.5888 20.9274 1.75389 20.9693C1.91898 21.0113 2.09205 21.0104 2.25669 20.9667L5.66969 19.9687C6.03741 19.8958 6.41822 19.9276 6.76869 20.0607C8.90408 21.0579 11.3231 21.2689 13.5988 20.6564C15.8746 20.0439 17.861 18.6473 19.2074 16.7131C20.5538 14.7788 21.1738 12.4311 20.958 10.0842C20.7422 7.73738 19.7044 5.54216 18.0278 3.88589C16.3511 2.22962 14.1434 1.21873 11.7941 1.03159C9.44475 0.844449 7.10483 1.49308 5.18713 2.86303C3.26944 4.23299 1.89722 6.23624 1.31258 8.51933C0.727946 10.8024 0.96846 13.2186 1.99169 15.3417Z" />
                                        </svg>
                                        <p>0</p>
                                    </div>
                                    <a href="./process/like_process.php?post_id=<?= $post['id'] ?>&csrf_token=<?= $_SESSION['csrf_token'] ?>" class="like-link">
                                        <svg width="15" height="14" viewBox="0 0 20 19"
                                            fill="<?= (isset($post['user_liked']) && $post['user_liked']) ? '#e0245e' : 'none' ?>"
                                            style="color: <?= (isset($post['user_liked']) && $post['user_liked']) ? '#e0245e' : 'currentColor' ?>;">
                                            <path d="M17.513 9.58341L10.013 17.0114L2.513 9.58341C2.0183 9.10202 1.62864 8.52342 1.36854 7.88404C1.10845 7.24466 0.983558 6.55836 1.00173 5.86834C1.01991 5.17832 1.18076 4.49954 1.47415 3.87474C1.76755 3.24994 2.18713 2.69266 2.70648 2.23799C3.22583 1.78331 3.8337 1.4411 4.49181 1.23289C5.14991 1.02468 5.844 0.954991 6.53036 1.02821C7.21673 1.10143 7.8805 1.31596 8.47987 1.65831C9.07925 2.00066 9.60124 2.46341 10.013 3.01741C10.4265 2.46743 10.9491 2.00873 11.5481 1.67001C12.1471 1.3313 12.8095 1.11986 13.4939 1.04893C14.1784 0.977998 14.8701 1.04911 15.5258 1.2578C16.1815 1.46649 16.787 1.80828 17.3045 2.26177C17.8221 2.71526 18.2404 3.27069 18.5334 3.8933C18.8264 4.51591 18.9877 5.19229 19.0073 5.88012C19.0269 6.56794 18.9043 7.2524 18.6471 7.89066C18.39 8.52891 18.0039 9.10723 17.513 9.58941"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <span><?= $post['like_count'] ?? 0 ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="msg-vide">Aucun like pour le moment.</p>
            <?php endif; ?>
        </section>
    </main>

    <?php require './includes/nav-right.php'; ?>

    <div id="edit-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <div class="left-header-modal">
                    <button class="close-button" type="button" onclick="closeEditModal()">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 6L6 18M6 6l12 12"></path>
                        </svg>
                    </button>
                    <h2>Éditer le profil</h2>
                </div>
                <button type="submit" form="edit-profil-form" class="save-button">Enregistrer</button>
            </div>

            <form id="edit-profil-form" class="edit-profil-form" action="./process/edit_profil_process.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="csrf_token" value="<?= generate_csrf_token() ?>">

                <div class="hero-edit">
                    <img class="banner-preview" src="assets/upload/banner/<?= htmlspecialchars($banner) ?>" alt="Bannière">
                    <div class="overlay-actions">
                        <label for="banner-upload" class="icon-button">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                <circle cx="12" cy="13" r="4"></circle>
                            </svg>
                        </label>
                        <input type="file" name="banner" id="banner-upload" accept="image/png, image/jpeg, image/jpg" style="display: none;">
                    </div>
                </div>

                <div class="avatar-edit-container">
                    <div class="avatar-wrapper">
                        <img class="avatar-preview" src="assets/upload/avatars/<?= htmlspecialchars($pp) ?>" alt="Avatar">
                        <label for="avatar-upload" class="icon-button">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2">
                                <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                                <circle cx="12" cy="13" r="4"></circle>
                            </svg>
                        </label>
                        <input type="file" name="avatar" id="avatar-upload" accept="image/png, image/jpeg, image/jpg" style="display: none;">
                    </div>
                </div>

                <div class="form-body">
                    <div class="input-edit">
                        <label>Nom</label>
                        <input type="text" name="real_name" value="<?= htmlspecialchars($realName) ?>">
                    </div>

                    <div class="input-edit">
                        <label>Bio</label>
                        <textarea name="bio" rows="4"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="assets/js/script-tabs.js"></script>
    <script src="assets/js/script-modal.js"></script>
</body>

</html>