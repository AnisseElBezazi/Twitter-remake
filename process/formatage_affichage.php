<?php
$pp = $user['avatar'] ?? 'profil-picture.jpg';
$banner = $user['banner'] ?? 'default-banner.jpg';
$realName = $user['real_name'] ?? $pseudo;
$bio = (!empty($user['bio'])) ? $user['bio'] : "Vous n'avez pas de bio.";

$dateDb = $user['created_at'];
$date = new DateTime($dateDb);

$mois = [
    1 => 'Janvier',
    2 => 'Février',
    3 => 'Mars',
    4 => 'Avril',
    5 => 'Mai',
    6 => 'Juin',
    7 => 'Juillet',
    8 => 'Août',
    9 => 'Septembre',
    10 => 'Octobre',
    11 => 'Novembre',
    12 => 'Décembre'
];
$numeroMois = (int)$date->format('m');
$annee = $date->format('Y');
$created = $mois[$numeroMois] . ' ' . $annee;
