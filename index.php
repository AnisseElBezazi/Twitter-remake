<?php
require_once('./includes/security.php');
require_once('./includes/functions.php');
require_once('./config/database.php');
require_once('./process/data_fetch.php');
require_once('./process/profil_fetch.php');
require_once('./process/formatage_affichage.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="body">

    <?php
    require './includes/header.php';
    ?>

    <main class="milieu-page">
        <div class="top">
            <h3><?= htmlspecialchars($currentMovieTitle) ?></h3>
            <?php if ($movieId): ?>
                <a href="index.php" style="color: var(--primary); font-size: 0.8rem;">Retour au flux global</a>
            <?php endif; ?>
        </div>
        <form class="post-form" action="./process/post_process.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

            <?php if ($movieId): ?>
                <input type="hidden" name="movie_id" value="<?= htmlspecialchars($movieId) ?>">
            <?php endif; ?>

            <div class="top-form">
                <div class="pp">
                    <img class="avatar" src="assets/upload/avatars/<?= htmlspecialchars($pp) ?>">
                </div>

                <textarea
                    class="input-post"
                    name="content"
                    placeholder="Quoi de neuf ?"></textarea>
            </div>
            <div id="preview-container" class="preview-container">
                <img id="preview-image" class="preview-image" src="">
                <button type="button" id="remove-preview" class="remove-preview">X</button>
            </div>
            <div class="bottom-form">
                <div class="upload-button">
                    <label for="post-image" style="cursor: pointer; display: flex;">
                        <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18 8.503V3C18 2.73478 17.8946 2.48043 17.7071 2.29289C17.5196 2.10536 17.2652 2 17 2H3C2.73478 2 2.48043 2.10536 2.29289 2.29289C2.10536 2.48043 2 2.73478 2 3V13C2 13.2652 2.10536 13.5196 2.29289 13.7071C2.48043 13.8946 2.73478 14 3 14H6.504L10.894 6.678C11.1283 6.28743 11.4484 5.95533 11.8302 5.70689C12.2119 5.45844 12.6452 5.30018 13.0972 5.24409C13.5492 5.188 14.008 5.23556 14.4389 5.38316C14.8697 5.53077 15.2613 5.77454 15.584 6.096L18 8.503ZM18 11.326L14.172 7.512C14.0644 7.40496 13.9338 7.32382 13.7902 7.27473C13.6465 7.22564 13.4936 7.2099 13.343 7.22869C13.1924 7.24748 13.048 7.30032 12.9208 7.38319C12.7937 7.46606 12.687 7.5768 12.609 7.707L8.836 14H17C17.2652 14 17.5196 13.8946 17.7071 13.7071C17.8946 13.5196 18 13.2652 18 13V11.326ZM3 0H17C17.7956 0 18.5587 0.31607 19.1213 0.87868C19.6839 1.44129 20 2.20435 20 3V13C20 13.7956 19.6839 14.5587 19.1213 15.1213C18.5587 15.6839 17.7956 16 17 16H3C2.20435 16 1.44129 15.6839 0.87868 15.1213C0.31607 14.5587 0 13.7956 0 13L0 3C0 2.20435 0.31607 1.44129 0.87868 0.87868C1.44129 0.31607 2.20435 0 3 0ZM6 9C5.20435 9 4.44129 8.68393 3.87868 8.12132C3.31607 7.55871 3 6.79565 3 6C3 5.20435 3.31607 4.44129 3.87868 3.87868C4.44129 3.31607 5.20435 3 6 3C6.79565 3 7.55871 3.31607 8.12132 3.87868C8.68393 4.44129 9 5.20435 9 6C9 6.79565 8.68393 7.55871 8.12132 8.12132C7.55871 8.68393 6.79565 9 6 9ZM6 7C6.26522 7 6.51957 6.89464 6.70711 6.70711C6.89464 6.51957 7 6.26522 7 6C7 5.73478 6.89464 5.48043 6.70711 5.29289C6.51957 5.10536 6.26522 5 6 5C5.73478 5 5.48043 5.10536 5.29289 5.29289C5.10536 5.48043 5 5.73478 5 6C5 6.26522 5.10536 6.51957 5.29289 6.70711C5.48043 6.89464 5.73478 7 6 7Z" fill="white" />
                            <circle cx="12" cy="13" r="4"></circle>
                        </svg>
                    </label>
                    <input type="file" name="image" id="post-image" accept="image/jpeg, image/png, image/webp" style="display: none;">
                </div>
                <button type="submit" class="primary-button">Poster</button>
            </div>
        </form>

        <section class="posts">
            <div class="nombre-posts">
                <h3>Flux d'actualité</h3>
            </div>

            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <div class="post">
                        <a href="post.php?id=<?= $post['id'] ?>" class="post-link"></a>
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
                                        <a href="post.php?id=<?= $post['id'] ?>" style="display: flex; align-items: center; gap: 5px; text-decoration: none; color: inherit;">
                                            <svg width="16" height="16" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.99169 15.3417C2.13873 15.7126 2.17147 16.119 2.08569 16.5087L1.02069 19.7987C0.986375 19.9655 0.995248 20.1384 1.04647 20.3008C1.09769 20.4633 1.18955 20.61 1.31336 20.727C1.43716 20.844 1.5888 20.9274 1.75389 20.9693C1.91898 21.0113 2.09205 21.0104 2.25669 20.9667L5.66969 19.9687C6.03741 19.8958 6.41822 19.9276 6.76869 20.0607C8.90408 21.0579 11.3231 21.2689 13.5988 20.6564C15.8746 20.0439 17.861 18.6473 19.2074 16.7131C20.5538 14.7788 21.1738 12.4311 20.958 10.0842C20.7422 7.73738 19.7044 5.54216 18.0278 3.88589C16.3511 2.22962 14.1434 1.21873 11.7941 1.03159C9.44475 0.844449 7.10483 1.49308 5.18713 2.86303C3.26944 4.23299 1.89722 6.23624 1.31258 8.51933C0.727946 10.8024 0.96846 13.2186 1.99169 15.3417Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <p><?= $post['comment_count'] ?? 0 ?></p>
                                        </a>
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
                <p class="msg-vide">Aucun message dans le flux pour le moment.</p>
            <?php endif; ?>
        </section>
    </main>
    <?php
    require './includes/nav-right.php';
    ?>
    <script src="assets/js/script-preview-post.js"></script>
</body>

</html>