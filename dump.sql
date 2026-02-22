-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 22 fév. 2026 à 14:01
-- Version du serveur : 8.4.3
-- Version de PHP : 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `secu_web`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `content`, `created_at`) VALUES
(5, 9, 1, 'complètement d\'accords', '2026-02-21 12:18:49'),
(6, 18, 1, 'sqs', '2026-02-21 12:33:56'),
(8, 18, 1, 'hola', '2026-02-21 14:01:13'),
(9, 8, 1, 'Dit bien', '2026-02-21 16:57:59'),
(10, 21, 5, 'oui', '2026-02-21 23:40:37');

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `likes`
--

INSERT INTO `likes` (`user_id`, `post_id`, `created_at`) VALUES
(1, 9, '2026-02-20 23:55:09'),
(1, 19, '2026-02-21 16:54:03'),
(5, 21, '2026-02-22 12:25:44');

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poster_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id`, `title`, `poster_path`, `description`, `created_at`) VALUES
(1, 'Arcane', 'Arcane-affiche.webp', NULL, '2026-02-19 20:03:27'),
(2, 'Naruto', 'naruto-affiche.jpg', NULL, '2026-02-19 20:03:27'),
(3, 'Memento', 'memento-affiche.jpg', NULL, '2026-02-19 20:03:27'),
(5, 'Hunger Games', 'Hunger-games-affiche.jpg', NULL, '2026-02-19 20:09:57'),
(6, 'Labyrinthe', 'labyrinthe-affiche.webp', '', '2026-02-19 20:09:57'),
(7, 'Le Prestige', 'Le-Prestige-affiche.jpg', '', '2026-02-19 20:09:57'),
(8, 'Avatar 3', 'Avatar-affiche.jpg', '', '2026-02-19 20:09:57'),
(9, 'Interstelar', 'interstelar-affiche.jpg', '', '2026-02-19 20:09:57'),
(12, 'One piece', '6999e50093250.jpg', NULL, '2026-02-21 18:01:52'),
(14, 'Jujutsu Kaisen 0', '699af9fc38903.avif', NULL, '2026-02-22 13:43:40');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `movie_id` int DEFAULT NULL,
  `content` varchar(280) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `movie_id`, `content`, `image_path`, `created_at`) VALUES
(4, 4, NULL, 'Salam les rhey', NULL, '2026-02-20 15:46:57'),
(7, 4, 1, 'Jinx est complètement fêlée, elle tire sur tout ce qui bouge. A Nanterre elle ne tiendrait même pas deux heures. Vi et sa coupe de cheveux éclatée, aucune prestance. Le Duc ne valide pas.', NULL, '2026-02-20 21:35:47'),
(8, 4, 2, 'Un renard dans le ventre et ça fait le caïd. Naruto a passé 15 ans à courir après Sasuke le fuyard. Dans le 92 on ne court pas après les traîtres, on les éteint. Rasengan sur vos carrières. La piraterie n\'est jamais finie.', NULL, '2026-02-20 21:35:47'),
(9, 4, 3, 'Le mec a plus de mémoire il se tatoue des post-it sur le torse. Achète un iPhone frérot. Oublier ses ennemis c\'est une faute grave. Moi je n\'oublie rien, la vengeance est un plat qui se mange glacé.', NULL, '2026-02-20 21:35:47'),
(11, 4, 5, 'Katniss joue à Robin des Bois avec un arc en plastique pendant que le Capitole mange du caviar. Ils se battent pour survivre dans une forêt artificielle, nous on a survécu à la street du 92. Différence de niveau.', NULL, '2026-02-20 21:35:47'),
(12, 4, 6, 'Courir dans un labyrinthe poursuivi par des robots-araignées. Achetez un GPS les gars. Thomas fait le héros mais il a zéro cardio. C\'est sombre d\'être aussi perdu dans la vie.', NULL, '2026-02-20 21:35:47'),
(13, 4, 7, 'Deux magiciens qui font des tours de passe-passe pour impressionner la galerie. La seule vraie magie c\'est de faire disparaître mes concurrents du top streaming.', NULL, '2026-02-20 21:35:47'),
(14, 4, 8, 'Encore les Schtroumpfs bleus géants. Cette fois ils sont dans l\'eau. James Cameron a cru on avait 4 heures à perdre à regarder des poissons extraterrestres. Retournez dans votre arbre.', NULL, '2026-02-20 21:35:47'),
(15, 4, 9, 'Cooper va dans l\'espace, il pleure devant des vidéos, il rentre sa fille a 100 ans. Grosse erreur de timing. Le temps c\'est de l\'argent, j\'ai pas le time pour les trous noirs.', NULL, '2026-02-20 21:35:47'),
(18, 1, NULL, '😂', NULL, '2026-02-21 12:26:01'),
(19, 1, NULL, 'sqsq', NULL, '2026-02-21 16:54:00'),
(20, 5, NULL, 'test post avec image', 'post_699a2f5e93532.jpg', '2026-02-21 23:19:10'),
(21, 5, NULL, 'test hauteur image', 'post_699a339441e46.jpg', '2026-02-21 23:37:08'),
(22, 5, NULL, '', 'post_699afb858d454.webp', '2026-02-22 13:50:13');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `real_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'profil-picture.jpg',
  `bio` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `banner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'banner_default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `real_name`, `pseudo`, `email`, `password`, `role`, `avatar`, `bio`, `created_at`, `banner`) VALUES
(1, 'Anisse', 'anisseel', 'anisse.elbezazi@gmail.com', '$2y$10$u3oE5iIKfb5sWz2G1s3vv.E0hfUpYejwcmpxhRD/bW1HmZVSVIKyC', 'admin', 'anisseel_avatar.jpg', '', '2026-02-19 20:28:37', 'anisseel_banner.jpg'),
(2, 'Jinx', 'Jinx', 'jinx@zaun.com', 'password_hash', 'user', 'profil-picture.jpg', NULL, '2026-02-19 20:58:32', 'banner_default.jpg'),
(3, '', 'sertyujkujhgfbdvcs', 'quefjkrgbhfkv@gmail.com', '$2y$10$nklVBlRbyPL2FThNAzvyT.WYCQXrE/tW9pr/krssU9UL/tHnmln/O', 'user', 'profil-picture.jpg', NULL, '2026-02-20 09:03:27', 'banner_default.jpg'),
(4, 'Booba', 'B2O', 'Booba@gmail.com', '$2y$10$anb/r7ebhaIGbE0AYIpeIu1mo2afak6XSIWT3bThumws.AlWtJ1oa', 'user', 'B2O_avatar.jpg', 'fait belek  à B2O', '2026-02-20 15:44:35', 'B2O_banner.jpg'),
(5, 'Test', 'testlocalstorage', 'test@gmail.com', '$2y$10$WOKP1RWDZLZ90lT2q.uxyeN0qhvoiKaqHij1cquCBPwtDmXY39rk2', 'admin', '5_avatar_1771761595.png', '', '2026-02-21 23:02:45', 'testlocalstorage_banner.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_comment_post` (`post_id`),
  ADD KEY `fk_comment_user` (`user_id`);

--
-- Index pour la table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`user_id`,`post_id`),
  ADD KEY `fk_like_post` (`post_id`);

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_post_user` (`user_id`),
  ADD KEY `fk_post_movie` (`movie_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comment_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_like_post` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_like_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `fk_post_movie` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_post_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
