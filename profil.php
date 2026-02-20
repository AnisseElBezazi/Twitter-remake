<?php 
require_once('./includes/security.php');
require_once('./includes/functions.php');
require_once './config/database.php';

$pseudo = $_SESSION['pseudo'];

$stmt = $pdo->prepare('SELECT * FROM users WHERE pseudo = :pseudo');
$stmt->execute([':pseudo' => $pseudo]);
$user = $stmt->fetch();
echo '<pre>';
var_dump ($user);
echo '<pre>';

$id = $user['id'];


$stmt = $pdo->prepare('SELECT COUNT(*) FROM posts WHERE user_id = :user_id');
$stmt->execute([':user_id' => $id]);
$nb_post = $stmt->fetchColumn();



$pp = $user['avatar'];
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
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->
    <title>Profil</title>
</head>
<body>
    <div>
        <div>
            <svg width="32" height="18" viewBox="0 0 32 18" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M25 10H7C6.44 10 6 9.56 6 9C6 8.44 6.44 8 7 8H25C25.56 8 26 8.44 26 9C26 9.56 25.56 10 25 10Z" fill="black"/>
<path d="M12 17C11.8688 17.0016 11.7388 16.9757 11.6183 16.9241C11.4977 16.8724 11.3893 16.7961 11.3 16.7L4.3 9.7C3.9 9.3 3.9 8.68 4.3 8.28L11.3 1.3C11.7 0.9 12.32 0.9 12.72 1.3C13.12 1.7 13.12 2.32 12.72 2.72L6.42 9.02L12.72 15.32C13.12 15.72 13.12 16.34 12.72 16.74C12.52 16.94 12.26 17.04 12.02 17.04L12 17Z" fill="black"/>
</svg>
<div>
      <span><?= $pseudo ?></span>
      <span><?= $nb_post ?> posts</span>
</div>
 <svg
              class="icone-user"
              width="27"
              height="32"
              viewBox="0 0 32 37"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M1 36V33.5C1 30.8478 2.05357 28.3043 3.92893 26.4289C5.8043 24.5536 8.34784 23.5 11 23.5H21C23.6522 23.5 26.1957 24.5536 28.0711 26.4289C29.9464 28.3043 31 30.8478 31 33.5V36M23.5 8.5C23.5 10.4891 22.7098 12.3968 21.3033 13.8033C19.8968 15.2098 17.9891 16 16 16C14.0109 16 12.1032 15.2098 10.6967 13.8033C9.29018 12.3968 8.5 10.4891 8.5 8.5C8.5 6.51088 9.29018 4.60322 10.6967 3.1967C12.1032 1.79018 14.0109 1 16 1C17.9891 1 19.8968 1.79018 21.3033 3.1967C22.7098 4.60322 23.5 6.51088 23.5 8.5Z"
                stroke-width="3"
                stroke-linecap="round"
              />
            </svg>
          
        </div>
    </div>
    

<img src="assets/upload/avatars/<?= $pp ?>" alt="" style="width: 80px; height: 120px;">
<img src="assets/upload/banner/<?= $pp ?>" alt="" style="width: 80px; height: 120px;">
<button>Edit profile</button>
<p><?= $pseudo ?></p>
<p>@<?= $pseudo ?></p>

<p>Joined <?= $created ?></p>

<p>Posts</p>
<p>Likes</p>
</body>
</html>