<section class="droite-page">
    <div class="top-droite-page">
        <div class="bar-recherche">
            <svg class="icone-loupe" width="22" height="22" viewBox="0 0 32 32" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M31 31L23.7617 23.7617M23.7617 23.7617C24.9999 22.5236 25.982 21.0537 26.6521 19.436C27.3222 17.8183 27.667 16.0845 27.667 14.3335C27.667 12.5825 27.3222 10.8487 26.6521 9.23101C25.982 7.61331 24.9999 6.14343 23.7617 4.9053C22.5236 3.66717 21.0537 2.68503 19.436 2.01495C17.8183 1.34488 16.0845 1 14.3335 1C12.5825 1 10.8487 1.34488 9.23101 2.01495C7.61331 2.68503 6.14343 3.66717 4.9053 4.9053C2.40478 7.40582 1 10.7973 1 14.3335C1 17.8698 2.40478 21.2612 4.9053 23.7617C7.40582 26.2623 10.7973 27.667 14.3335 27.667C17.8698 27.667 21.2612 26.2623 23.7617 23.7617Z"
                    stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <input class="research" type="text" placeholder="Rechercher une discussion" />
        </div>
    </div>

    <div class="list-film">
        <h3 class="title">Salons Populaires</h3>

        <?php if (!empty($movies)): ?>
            <?php foreach ($movies as $movie): ?>
                <a href="index.php?movie_id=<?= $movie['id'] ?>" class="card-link"
                    style="text-decoration: none; color: inherit;">
                    <div class="card">
                        <h4 class="title"><?= htmlspecialchars($movie['title']) ?></h4>
                        <div class="affiche">
                            <img src="assets/img/<?= htmlspecialchars($movie['poster_path']) ?>"
                                alt="<?= htmlspecialchars($movie['title']) ?>" />
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="msg-vide">Aucun salon disponible pour le moment.</p>
        <?php endif; ?>
    </div>
        <script src="assets/js/search-bar.js"></script>
</section>