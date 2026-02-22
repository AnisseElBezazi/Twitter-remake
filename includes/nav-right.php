</section>

<section class="droite-page">
    <div class="top-droite-page">
        <div class="bar-recherche">
            <svg class="icone-loupe" width="22" height="22" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M31 31L23.7617 23.7617M23.7617 23.7617C24.9999 22.5236 25.982 21.0537 26.6521 19.436C27.3222 17.8183 27.667 16.0845 27.667 14.3335C27.667 12.5825 27.3222 10.8487 26.6521 9.23101C25.982 7.61331 24.9999 6.14343 23.7617 4.9053C22.5236 3.66717 21.0537 2.68503 19.436 2.01495C17.8183 1.34488 16.0845 1 14.3335 1C12.5825 1 10.8487 1.34488 9.23101 2.01495C7.61331 2.68503 6.14343 3.66717 4.9053 4.9053C2.40478 7.40582 1 10.7973 1 14.3335C1 17.8698 2.40478 21.2612 4.9053 23.7617C7.40582 26.2623 10.7973 27.667 14.3335 27.667C17.8698 27.667 21.2612 26.2623 23.7617 23.7617Z" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <input class="research" type="text" placeholder="Rechercher un salon" />
        </div>
        <div id="admin-add-movie-btn-container"></div>
    </div>

    <div class="list-film">
        <h3 class="title">Salons Populaires</h3>

        <?php if (!empty($movies)): ?>
            <?php foreach ($movies as $movie): ?>
                <div style="position: relative; display: inline-block; width: 100%;">
                    <a href="index.php?movie_id=<?= $movie['id'] ?>" class="card-link" style="text-decoration: none; color: inherit; display: block;">
                        <div class="card">
                            <h4 class="title"><?= htmlspecialchars($movie['title']) ?></h4>
                            <div class="affiche">
                                <img src="assets/img/<?= htmlspecialchars($movie['poster_path']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>" />
                            </div>
                            <button class="admin-delete-movie-btn" data-id="<?= $movie['id'] ?>" style="display: none; position: absolute; top: 10px; right: 10px; background: rgba(229, 9, 20, 0.8); color: white; border: none; border-radius: 50%; width: 30px; height: 30px; cursor: pointer; z-index: 10; align-items: center; justify-content: center;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </button>
                        </div>
                    </a>

                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="msg-vide">Aucun salon disponible pour le moment.</p>
        <?php endif; ?>
    </div>
</section>

<div id="add-movie-modal" class="modal" style="display:none;">
    <div class="modal-content-movie">
        <div class="modal-header">
            <div class="left-header-modal">
                <button class="close-button" onclick="closeAddMovieModal()">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6L6 18M6 6l12 12" />
                    </svg>
                </button>
                <h2>Ajouter un film / série</h2>
            </div>
        </div>

        <form id="add-movie-form" class="add-movie-form" enctype="multipart/form-data" method="POST" action="process/add_movie_process.php">
            <div class="input-group">
                <label for="movie-title">Nom du film / série</label>
                <input type="text" id="movie-title" name="title" placeholder="Entrez le nom du film" required>
            </div>

            <div class="input-group">
                <label for="movie-poster">Image (affiche)</label>
                <input type="file" id="movie-poster" name="poster" accept="image/*" required>
            </div>

            <button type="submit" class="primary-button">Ajouter à la liste de salons</button>
        </form>
    </div>
</div>
<script src="assets/js/modal-admin.js"></script>
<script src="assets/js/search-bar.js"></script>
</section>