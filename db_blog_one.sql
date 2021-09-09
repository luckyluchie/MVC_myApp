-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 09 sep. 2021 à 15:37
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_blog_one`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author`, `comment`, `comment_date`) VALUES
(1, 2, 'Mathieu', 'Preum\'s', '2017-09-24 17:12:30'),
(2, 2, 'Sam', 'Quelqu\'un a un avis là-dessus ? Je ne sais pas quoi en penser.', '2017-09-24 17:21:34'),
(8, 1, 'Jojo', 'C\'est moi !', '2017-09-28 19:50:14'),
(9, 2, 'Mathieu', 'Retest\r\nEncore', '2017-10-27 11:46:50'),
(10, 2, 'Sam', 'tu testes quoi ?', '2017-10-27 15:44:14'),
(12, 2, 'lucie', 'trer', '2021-07-07 16:49:42'),
(17, 2, 'lucie', 'nouveau commentaire', '2021-07-09 16:41:47'),
(18, 1, 'lucie', 'hello', '2021-07-16 11:49:17'),
(19, 2, 'lucie', 'Oh ça faisait longtemps que je t\'avais pas vu!', '2021-07-26 19:32:47'),
(20, 2, 'lucie', 'ihàçç)çujç)', '2021-08-16 12:10:59'),
(21, 1, 'lucie', 'jkhiohoiho', '2021-08-16 12:40:04'),
(22, 12, 'lucie', 'tryryrteytyed', '2021-08-16 16:22:41'),
(23, 8, 'dfdsf', 'dfdfds', '2021-08-16 16:52:06'),
(24, 14, 'yuty', 'yuytuyutyuyt', '2021-08-16 16:58:22'),
(25, 15, 'lucie', 't_çttç_èt', '2021-08-16 17:06:00'),
(26, 15, 'lucie', 'yuhfgyyt', '2021-08-16 17:12:58'),
(27, 18, 'lucie', 'dfsfsfd', '2021-08-16 17:27:52'),
(28, 48, 'lucie', 'gfdsgfgsx', '2021-08-18 13:57:44'),
(29, 56, 'lucie', 'ijhihpi', '2021-08-18 18:38:11'),
(30, 81, 'lucie', 'ioyoyà', '2021-08-20 10:37:29'),
(31, 102, 'lucie', 'ghhsrh ghr', '2021-09-01 10:58:52'),
(32, 110, 'jesuisadmin2', 'gfhtfghgc', '2021-09-01 15:12:36'),
(34, 110, 'AUtEUr', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas et ornare sapien. Donec eget risus a lorem finibus commodo. Nam id turpis quis augue condimentum finibus. Duis ex nisi, fringilla sed suscipit porttitor, vestibulum sed diam. Nullam dictum neque id velit consequat, in accumsan urna mattis. Morbi viverra ante ut lorem ultricies iaculis. Suspendisse vel lectus interdum, laoreet mauris id, luctus mi. Quisque aliquam facilisis ullamcorper. Etiam vestibulum, elit nec pellentesque porta, odio metus gravida nulla, sit amet sodales tellus leo in risus. Donec non arcu id diam maximus convallis.', '0000-00-00 00:00:00'),
(37, 0, 'jesuisadmin2', 'try\'(etsr', '2021-09-05 18:44:30'),
(38, 110, 'jesuisadmin2', 'hth\'(er-y', '2021-09-05 18:46:34'),
(39, 110, 'jesuisadmin2', 'hjtyuj èuiè_', '2021-09-05 18:46:43'),
(40, 110, 'jesuisadmin2', 'hjfytcfv ytuy', '2021-09-05 18:48:51'),
(41, 110, 'jesuisadmin2', 'hhhhh', '2021-09-05 18:48:57'),
(42, 110, 'jesuisadmin2', 'rtyhgtr', '2021-09-05 19:09:19'),
(43, 110, 'jesuisadmin2', 'gggggg', '2021-09-05 19:09:26'),
(44, 110, 'jesuisadmin2', 'gfygrt yyyyyyyyyyyyyyy', '2021-09-05 19:12:44');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `redactor` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `creation_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `redactor`, `title`, `content`, `image`, `creation_date`) VALUES
(92, 'marie', 'référencement site', 'hnghg', 'sunset-2739472_640.jpg', '2021-08-22 16:04:47'),
(95, 'HULK HULK', 'doe', 'dfsdf rgre r', 'australian-shepherd-6556697_640.jpg', '2021-08-22 16:06:16'),
(102, 'spiderman', 'référencement site', 'gfdgfdfg', NULL, '2021-08-23 18:29:33'),
(110, 'marie', 'retertte', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ut nisl non mi ullamcorper commodo in sit amet est. Cras eu volutpat turpis, eu fermentum ipsum. Etiam ut rutrum augue. Nullam posuere orci at malesuada tincidunt. Etiam viverra et arcu at ultrices. Aenean porttitor tortor at erat placerat vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam lacinia, ante et convallis auctor, nulla nisl commodo lectus, eu semper diam diam a purus. Sed lacinia, dolor quis volutpat tincidunt, sem magna tincidunt purus, in sodales turpis lectus eu odio. Praesent et turpis vestibulum, congue orci laoreet, tempus libero. Fusce in urna velit. Aliquam luctus dui sed diam blandit ultricies. Donec et neque quis nisi scelerisque aliquet. Sed tincidunt erat tellus, quis feugiat lorem accumsan quis. Etiam vel accumsan diam, volutpat iaculis felis. Quisque ac sollicitudin enim, id sollicitudin diam.\r\n\r\nFusce a sollicitudin nisi, eget semper diam. Aenean mollis massa dapibus, faucibus eros id, accumsan dui. Integer porttitor rhoncus nunc, nec porta tortor volutpat vitae. Fusce sollicitudin tempus ligula sit amet egestas. Morbi auctor aliquet nunc, vitae semper purus ornare at. Phasellus efficitur in ipsum sit amet luctus. Proin laoreet turpis velit, facilisis euismod purus tempus a. Vivamus non sagittis magna. Donec eu arcu mauris. Pellentesque ac diam ante. Maecenas consequat congue lorem.', NULL, '2021-09-01 11:03:35'),
(111, 'jojo', 'Les ours', 'fdfdrf rttertf jyugkug', NULL, '2021-09-07 15:22:22'),
(112, 'ggg', 'mise en ligne site', 'ghdrty uikuyf trytrd', NULL, '2021-09-07 15:22:35');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `roleName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `roleName`) VALUES
(1, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` char(255) DEFAULT NULL,
  `idRole` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `idRole`) VALUES
(16, 'jesuisadmin2', 'jesuisadmin2@mail.com', '$2y$10$LXYk8b0pchyKtKdvRQfGIe/5/SNVduyWx1TLWqfbnPR6tvQx/i4vy', 1),
(23, 'jesuisadmin3', 'jesuisadmin3@mail.com', '$2y$10$ITNOGqb1TvrKwqm8K1HQOO29poVb/xd51o/ZCMfAQo1PbY2342XhS', 0),
(87, 'lucie', 'lucie@mail.com', '$2y$10$Ue5Ll1/ccw0fZj3b0Rc/CuG3lhTm/kKZQ64be.5WYA8DwDu/xu.qq', 0),
(88, 'loic', 'loic@mail.com', '$2y$10$2JAKDecBESk3yiHVfVC4Y.rvtnk5O580IxaAIY1VJtCsqGm02Onf2', 0),
(90, 'lllucie', 'llllllucie@admin.com', '$2y$10$pcNiRgLPQB4q.WQv8cSjy.0qMAexdI8Qt7xY9ZVcqBSbp5WEvndoe', 0),
(91, 'Luckyluchie', 'lucky@mail.com', '$2y$10$RpnGGAle8I4YCttoLh20TemR/xBUjDPUg7yLzJtL8oMeZTHpTf.Jy', 0),
(93, 'mmm', 'm@mail.com', '$2y$10$HqS0QsMdx2CHthqY4/.iDeAIlimtU/OTgrib0z/Vq21PhaO.duD/O', 0),
(97, 'Luckyluchie88', 'lucky88@mail.com', '$2y$10$y1txXEVS29qXaFRnSRgH0.9LR0Yu9KePPOyTtvs2RUfB/CHSPRL3u', 0),
(104, 'Luckyluchie99', 'lucky99@mail.com', '$2y$10$tAIn3sN7aila5pouTGyBuuT4NabFQKeATqKYB4ryLwkcnBPvDU.R2', 0),
(105, 'hhhhh', 'h@mail.com', '$2y$10$U7zFtV2Ls6qAPXA7QafK.OVvx6fqzqOEKoIYly6NwFXFGDLeD0TPG', 0),
(106, 'fdsfd/rfed', 'hfff@mail.com', '$2y$10$mYmvCqb7LwG5ivY3Rg7m5.3eqvttI/GbwmK.N1hcE/M0/5t6EGvmy', 0),
(107, 'lulu', 'lulu@mail.fr', '$2y$10$/iR7d9p75tEIhcPIklqjP.OsxO8mLfwCvIi87AdhXzsik4RSzJ25a', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
