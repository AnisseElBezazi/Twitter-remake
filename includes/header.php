<?php $current_page = basename($_SERVER['PHP_SELF']); ?>


<nav class="left-header">
  <div>
    <div class="logo">FlixThread</div>
    <ul class="navigation">
      <a href="index.php" style="text-decoration: none; color: inherit;">
        <li class="link <?= ($current_page == 'index.php') ? 'active' : '' ?>">
          <svg
            class="icone-maison"
            width="27"
            height="27"
            viewBox="0 0 32 32"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M1 15.3084V25.1257C1 27.1817 1 28.2097 1.40875 28.9972C1.76875 29.6875 2.34063 30.2492 3.0475 30.5998C3.84812 31 4.89812 31 6.99438 31H25.0056C27.1019 31 28.15 31 28.9506 30.5998C29.6566 30.2486 30.2309 29.6876 30.5912 28.9972C31 28.2116 31 27.1854 31 25.1331V15.3084C31 14.3281 31 13.838 30.8781 13.3809C30.7702 12.9769 30.5926 12.5938 30.3531 12.2483C30.0813 11.8573 29.7062 11.5324 28.9506 10.888L19.9506 3.17806C18.5519 1.97935 17.8506 1.37907 17.0631 1.15145C16.3694 0.949518 15.6306 0.949518 14.935 1.15145C14.1475 1.37907 13.45 1.97751 12.0513 3.17439L3.04937 10.888C2.29562 11.5342 1.91875 11.8573 1.64875 12.2464C1.40837 12.5924 1.23018 12.9761 1.12188 13.3809C1 13.8362 1 14.3281 1 15.3084Z"
              stroke-width="3"
              stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
          <h3>Accueil</h3>
        </li>
      </a>

      <a href="explorer.php" style="text-decoration: none; color: inherit;">
        <li class="link <?= ($current_page == 'explorer.php') ? 'active' : '' ?>">
          <svg
            class=" icone-loupe"
            width="27"
            height="27"
            viewBox="0 0 32 32"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M31 31L23.7617 23.7617M23.7617 23.7617C24.9999 22.5236 25.982 21.0537 26.6521 19.436C27.3222 17.8183 27.667 16.0845 27.667 14.3335C27.667 12.5825 27.3222 10.8487 26.6521 9.23101C25.982 7.61331 24.9999 6.14343 23.7617 4.9053C22.5236 3.66717 21.0537 2.68503 19.436 2.01495C17.8183 1.34488 16.0845 1 14.3335 1C12.5825 1 10.8487 1.34488 9.23101 2.01495C7.61331 2.68503 6.14343 3.66717 4.9053 4.9053C2.40478 7.40582 1 10.7973 1 14.3335C1 17.8698 2.40478 21.2612 4.9053 23.7617C7.40582 26.2623 10.7973 27.667 14.3335 27.667C17.8698 27.667 21.2612 26.2623 23.7617 23.7617Z"
              stroke-width="3"
              stroke-linecap="round"
              stroke-linejoin="round" />
          </svg>
          <h3>Explorer</h3>
        </li>
      </a>
      <a href="profil.php" style="text-decoration: none; color: inherit;">
        <li class="link profil <?= ($current_page == 'profil.php') ? 'active' : '' ?>">

          <svg
            class="icone-user"
            width="27"
            height="32"
            viewBox="0 0 32 37"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M1 36V33.5C1 30.8478 2.05357 28.3043 3.92893 26.4289C5.8043 24.5536 8.34784 23.5 11 23.5H21C23.6522 23.5 26.1957 24.5536 28.0711 26.4289C29.9464 28.3043 31 30.8478 31 33.5V36M23.5 8.5C23.5 10.4891 22.7098 12.3968 21.3033 13.8033C19.8968 15.2098 17.9891 16 16 16C14.0109 16 12.1032 15.2098 10.6967 13.8033C9.29018 12.3968 8.5 10.4891 8.5 8.5C8.5 6.51088 9.29018 4.60322 10.6967 3.1967C12.1032 1.79018 14.0109 1 16 1C17.9891 1 19.8968 1.79018 21.3033 3.1967C22.7098 4.60322 23.5 6.51088 23.5 8.5Z"
              stroke-width="3"
              stroke-linecap="round" />
          </svg>
          <h3>Profil</h3>

        </li>
      </a>
      <button class="primary-button" onclick="openPostModal()">Poster</button>
    </ul>
  </div>

  <div class="compte-deconnexion">
    <div class="pp">
      <img class="avatar" src="assets/upload/avatars/<?= htmlspecialchars($pp) ?>">
    </div>
    <div class="pseudo">
      <p class="name"><?= htmlspecialchars($realName) ?></p>
      <p class="real-name">@<?= htmlspecialchars($pseudo) ?></p>
    </div>
    <form action="./process/logout.php" method="POST" style="display: flex; align-items: center; margin: 0;">
      <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
      <button type="submit" class="deconnexion" style="background: none; border: none; padding: 0; cursor: pointer;">
        <svg class="icone-logout" width="17" height="21" viewBox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M8.59317 20.2584L8.58217 20.2604L8.51117 20.2954L8.49117 20.2994L8.47717 20.2954L8.40617 20.2604C8.39551 20.2571 8.3875 20.2588 8.38217 20.2654L8.37817 20.2754L8.36117 20.7034L8.36617 20.7234L8.37617 20.7364L8.48017 20.8104L8.49517 20.8144L8.50717 20.8104L8.61117 20.7364L8.62317 20.7204L8.62717 20.7034L8.61017 20.2764C8.6075 20.2658 8.60184 20.2598 8.59317 20.2584ZM8.85817 20.1454L8.84517 20.1474L8.66017 20.2404L8.65017 20.2504L8.64717 20.2614L8.66517 20.6914L8.67017 20.7034L8.67817 20.7104L8.87917 20.8034C8.89184 20.8068 8.9015 20.8041 8.90817 20.7954L8.91217 20.7814L8.87817 20.1674C8.87484 20.1554 8.86817 20.1481 8.85817 20.1454ZM8.14317 20.1474C8.13876 20.1448 8.1335 20.1439 8.12847 20.145C8.12344 20.1461 8.11903 20.1491 8.11617 20.1534L8.11017 20.1674L8.07617 20.7814C8.07684 20.7934 8.08251 20.8014 8.09317 20.8054L8.10817 20.8034L8.30917 20.7104L8.31917 20.7024L8.32317 20.6914L8.34017 20.2614L8.33717 20.2494L8.32717 20.2394L8.14317 20.1474Z" fill="white" />
          <path d="M8 0C8.25488 0.000282707 8.50003 0.0978791 8.68537 0.272848C8.8707 0.447818 8.98224 0.686953 8.99717 0.941395C9.01211 1.19584 8.92933 1.44638 8.76574 1.64183C8.60215 1.83729 8.3701 1.9629 8.117 1.993L8 2H3C2.75507 2.00003 2.51866 2.08996 2.33563 2.25272C2.15259 2.41547 2.03566 2.63975 2.007 2.883L2 3V15C2.00003 15.2449 2.08996 15.4813 2.25272 15.6644C2.41547 15.8474 2.63975 15.9643 2.883 15.993L3 16H7.5C7.75488 16.0003 8.00003 16.0979 8.18537 16.2728C8.3707 16.4478 8.48224 16.687 8.49717 16.9414C8.51211 17.1958 8.42933 17.4464 8.26574 17.6418C8.10215 17.8373 7.8701 17.9629 7.617 17.993L7.5 18H3C2.23479 18 1.49849 17.7077 0.941739 17.1827C0.384993 16.6578 0.0498925 15.9399 0.00500012 15.176L4.66045e-09 15V3C-4.26217e-05 2.23479 0.292325 1.49849 0.817284 0.941739C1.34224 0.384993 2.06011 0.0498925 2.824 0.00500011L3 0H8ZM13.707 5.464L16.535 8.293C16.7225 8.48053 16.8278 8.73484 16.8278 9C16.8278 9.26516 16.7225 9.51947 16.535 9.707L13.707 12.536C13.5194 12.7235 13.2649 12.8288 12.9996 12.8287C12.7344 12.8286 12.48 12.7231 12.2925 12.5355C12.105 12.3479 11.9997 12.0934 11.9998 11.8281C11.9999 11.5629 12.1054 11.3085 12.293 11.121L13.414 10H8C7.73478 10 7.48043 9.89464 7.29289 9.70711C7.10536 9.51957 7 9.26522 7 9C7 8.73478 7.10536 8.48043 7.29289 8.29289C7.48043 8.10536 7.73478 8 8 8H13.414L12.293 6.879C12.1054 6.69149 11.9999 6.43712 11.9998 6.17185C11.9997 5.90658 12.105 5.65214 12.2925 5.4645C12.48 5.27686 12.7344 5.17139 12.9996 5.1713C13.2649 5.1712 13.5194 5.27649 13.707 5.464Z" fill="white" />
        </svg>
      </button>
    </form>
  </div>
</nav>

<div id="post-modal" class="modal" style="display: none;">
  <div class="modal-content-post">
    <div class="modal-header">
      <button class="close-button" onclick="closePostModal()">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
          <path d="M18 6L6 18M6 6l12 12" />
        </svg>
      </button>
    </div>

    <form class="post-form" action="./process/post_process.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

      <?php if (isset($movieId) && $movieId): ?>
        <input type="hidden" name="movie_id" value="<?= htmlspecialchars($movieId) ?>">
      <?php endif; ?>

      <div class="top-form">
        <div class="pp">
          <img class="avatar" src="assets/upload/avatars/<?= htmlspecialchars($pp) ?>">
        </div>
        <textarea class="input-post" name="content" placeholder="Quoi de neuf ?"></textarea>
      </div>

      <div id="modal-preview-container" class="preview-container" style="display: none;">
        <img id="modal-preview-image" class="preview-image" src="">
        <button type="button" id="modal-remove-preview" class="remove-preview">X</button>
      </div>

      <div class="bottom-form">
        <div class="upload-button">
          <label for="modal-post-image" style="cursor: pointer; display: flex;">
            <svg width="20" height="16" viewBox="0 0 20 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M18 8.503V3C18 2.73478 17.8946 2.48043 17.7071 2.29289C17.5196 2.10536 17.2652 2 17 2H3C2.73478 2 2.48043 2.10536 2.29289 2.29289C2.10536 2.48043 2 2.73478 2 3V13C2 13.2652 2.10536 13.5196 2.29289 13.7071C2.48043 13.8946 2.73478 14 3 14H6.504L10.894 6.678C11.1283 6.28743 11.4484 5.95533 11.8302 5.70689C12.2119 5.45844 12.6452 5.30018 13.0972 5.24409C13.5492 5.188 14.008 5.23556 14.4389 5.38316C14.8697 5.53077 15.2613 5.77454 15.584 6.096L18 8.503ZM18 11.326L14.172 7.512C14.0644 7.40496 13.9338 7.32382 13.7902 7.27473C13.6465 7.22564 13.4936 7.2099 13.343 7.22869C13.1924 7.24748 13.048 7.30032 12.9208 7.38319C12.7937 7.46606 12.687 7.5768 12.609 7.707L8.836 14H17C17.2652 14 17.5196 13.8946 17.7071 13.7071C17.8946 13.5196 18 13.2652 18 13V11.326ZM3 0H17C17.7956 0 18.5587 0.31607 19.1213 0.87868C19.6839 1.44129 20 2.20435 20 3V13C20 13.7956 19.6839 14.5587 19.1213 15.1213C18.5587 15.6839 17.7956 16 17 16H3C2.20435 16 1.44129 15.6839 0.87868 15.1213C0.31607 14.5587 0 13.7956 0 13L0 3C0 2.20435 0.31607 1.44129 0.87868 0.87868C1.44129 0.31607 2.20435 0 3 0ZM6 9C5.20435 9 4.44129 8.68393 3.87868 8.12132C3.31607 7.55871 3 6.79565 3 6C3 5.20435 3.31607 4.44129 3.87868 3.87868C4.44129 3.31607 5.20435 3 6 3C6.79565 3 7.55871 3.31607 8.12132 3.87868C8.68393 4.44129 9 5.20435 9 6C9 6.79565 8.68393 7.55871 8.12132 8.12132C7.55871 8.68393 6.79565 9 6 9ZM6 7C6.26522 7 6.51957 6.89464 6.70711 6.70711C6.89464 6.51957 7 6.26522 7 6C7 5.73478 6.89464 5.48043 6.70711 5.29289C6.51957 5.10536 6.26522 5 6 5C5.73478 5 5.48043 5.10536 5.29289 5.29289C5.10536 5.48043 5 5.73478 5 6C5 6.26522 5.10536 6.51957 5.29289 6.70711C5.48043 6.89464 5.73478 7 6 7Z" fill="white" />
            </svg>
          </label>
          <input type="file" name="image" id="modal-post-image" accept="image/jpeg, image/png, image/webp" style="display: none;">
        </div>
        <button type="submit" class="primary-button">Poster</button>
      </div>
    </form>
  </div>
</div>
<script src="assets/js/modal-post.js"></script>