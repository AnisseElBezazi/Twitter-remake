-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 20 fév. 2026 à 21:14
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
  `content` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `likes`
--

CREATE TABLE `likes` (
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `poster_path` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id`, `title`, `poster_path`, `description`, `created_at`) VALUES
(1, 'Arcane', 'Arcane-affiche.webp', NULL, '2026-02-19 20:03:27'),
(2, 'Naruto', 'naruto-affiche.jpg', NULL, '2026-02-19 20:03:27'),
(3, 'Memento', 'memento-affiche.jpg', NULL, '2026-02-19 20:03:27'),
(4, 'One Piece', 'onepiece-affiche.jpg', NULL, '2026-02-19 20:03:27'),
(5, 'Hunger Games', 'Hunger-games-affiche.jpg', NULL, '2026-02-19 20:09:57'),
(6, 'Labyrinthe', 'labyrinthe-affiche.webp', '', '2026-02-19 20:09:57'),
(7, 'Le Prestige', 'Le-Prestige-affiche.jpg', '', '2026-02-19 20:09:57'),
(8, 'Avatar 3', 'Avatar-affiche.jpg', '', '2026-02-19 20:09:57'),
(9, 'Interstelar', 'interstelar-affiche.jpg', '', '2026-02-19 20:09:57');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `movie_id` int DEFAULT NULL,
  `content` varchar(280) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `movie_id`, `content`, `image_path`, `created_at`) VALUES
(1, 1, 1, 'Franchement la saison 2 d\'Arcane est une masterclass visuelle !', NULL, '2026-02-19 20:58:32'),
(2, 3, 2, 'Est-ce que quelqu\'un sait quand sortent les prochains chapitres ?', NULL, '2026-02-19 20:58:32'),
(3, 3, 3, 'Je viens de revoir Memento, je n\'ai toujours rien compris à la fin...', 'img-test.png', '2026-02-19 20:58:32'),
(4, 4, NULL, 'Salam les rhey', NULL, '2026-02-20 15:46:57'),
(5, 1, NULL, 'Test', NULL, '2026-02-20 18:46:35'),
(6, 1, NULL, 'dssqdsq', NULL, '2026-02-20 19:03:20'),
(7, 4, 1, 'Jinx est complètement fêlée, elle tire sur tout ce qui bouge. A Nanterre elle ne tiendrait même pas deux heures. Vi et sa coupe de cheveux éclatée, aucune prestance. Le Duc ne valide pas.', NULL, '2026-02-20 21:35:47'),
(8, 4, 2, 'Un renard dans le ventre et ça fait le caïd. Naruto a passé 15 ans à courir après Sasuke le fuyard. Dans le 92 on ne court pas après les traîtres, on les éteint. Rasengan sur vos carrières. La piraterie n\'est jamais finie.', NULL, '2026-02-20 21:35:47'),
(9, 4, 3, 'Le mec a plus de mémoire il se tatoue des post-it sur le torse. Achète un iPhone frérot. Oublier ses ennemis c\'est une faute grave. Moi je n\'oublie rien, la vengeance est un plat qui se mange glacé.', NULL, '2026-02-20 21:35:47'),
(10, 4, 4, 'Luffy a les bras élastiques, il s\'étire comme mes royalties. Mais ça fait 25 ans qu\'ils cherchent un trésor imaginaire en sandales. La vraie piraterie c\'est nous, pas ces baltringues en chapeau de paille.', NULL, '2026-02-20 21:35:47'),
(11, 4, 5, 'Katniss joue à Robin des Bois avec un arc en plastique pendant que le Capitole mange du caviar. Ils se battent pour survivre dans une forêt artificielle, nous on a survécu à la street du 92. Différence de niveau.', NULL, '2026-02-20 21:35:47'),
(12, 4, 6, 'Courir dans un labyrinthe poursuivi par des robots-araignées. Achetez un GPS les gars. Thomas fait le héros mais il a zéro cardio. C\'est sombre d\'être aussi perdu dans la vie.', NULL, '2026-02-20 21:35:47'),
(13, 4, 7, 'Deux magiciens qui font des tours de passe-passe pour impressionner la galerie. La seule vraie magie c\'est de faire disparaître mes concurrents du top streaming.', NULL, '2026-02-20 21:35:47'),
(14, 4, 8, 'Encore les Schtroumpfs bleus géants. Cette fois ils sont dans l\'eau. James Cameron a cru on avait 4 heures à perdre à regarder des poissons extraterrestres. Retournez dans votre arbre.', NULL, '2026-02-20 21:35:47'),
(15, 4, 9, 'Cooper va dans l\'espace, il pleure devant des vidéos, il rentre sa fille a 100 ans. Grosse erreur de timing. Le temps c\'est de l\'argent, j\'ai pas le time pour les trous noirs.', NULL, '2026-02-20 21:35:47');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `real_name` varchar(255) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'profil-picture.jpg',
  `bio` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `banner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'banner_default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `real_name`, `pseudo`, `email`, `password`, `role`, `avatar`, `bio`, `created_at`, `banner`) VALUES
(1, 'Anisse', 'anisseel', 'anisse.elbezazi@gmail.com', '$2y$10$u3oE5iIKfb5sWz2G1s3vv.E0hfUpYejwcmpxhRD/bW1HmZVSVIKyC', 'user', 'profil-picture.jpg', NULL, '2026-02-19 20:28:37', 'banner_default.jpg'),
(2, 'Jinx', 'Jinx', 'jinx@zaun.com', 'password_hash', 'user', 'profil-picture.jpg', NULL, '2026-02-19 20:58:32', 'banner_default.jpg'),
(3, '', 'sertyujkujhgfbdvcs', 'quefjkrgbhfkv@gmail.com', '$2y$10$nklVBlRbyPL2FThNAzvyT.WYCQXrE/tW9pr/krssU9UL/tHnmln/O', 'user', 'profil-picture.jpg', NULL, '2026-02-20 09:03:27', 'banner_default.jpg'),
(4, 'Booba', 'B2O', 'Booba@gmail.com', '$2y$10$anb/r7ebhaIGbE0AYIpeIu1mo2afak6XSIWT3bThumws.AlWtJ1oa', 'user', 'B2O_avatar.jpg', 'fait belek  à B2O', '2026-02-20 15:44:35', 'B2O_banner.jpg');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
