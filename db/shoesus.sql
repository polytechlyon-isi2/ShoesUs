-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 04 Avril 2016 à 19:23
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  7.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `shoesus`
--

-- --------------------------------------------------------

--
-- Structure de la table `s_bag`
--

CREATE TABLE `s_bag` (
  `bag_id` int(11) NOT NULL,
  `bag_user` int(11) NOT NULL,
  `bag_prod` int(11) NOT NULL,
  `bag_prod_nbr` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `s_bag`
--

INSERT INTO `s_bag` (`bag_id`, `bag_user`, `bag_prod`, `bag_prod_nbr`) VALUES
(1, 1, 1, 1),
(7, 6, 2, 4);

-- --------------------------------------------------------

--
-- Structure de la table `s_category`
--

CREATE TABLE `s_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `s_category`
--

INSERT INTO `s_category` (`cat_id`, `cat_name`) VALUES
(1, 'Baskets'),
(2, 'Chaussures de ville'),
(3, 'Mocassins'),
(4, 'Espadrilles');

-- --------------------------------------------------------

--
-- Structure de la table `s_product`
--

CREATE TABLE `s_product` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `prod_desc` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `prod_price` int(11) NOT NULL,
  `prod_cat` int(11) NOT NULL,
  `prod_image` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `s_product`
--

INSERT INTO `s_product` (`prod_id`, `prod_name`, `prod_desc`, `prod_price`, `prod_cat`, `prod_image`) VALUES
(1, '991 New Balance', 'La chaussure qui a défini New Balance, notre sneaker 991 réalisée en daim et dotée d''un coussin pour un style et confort imbattable.', 186, 1, 'images/nb_991.jpg'),
(2, '999 Elite Edition Paper Lights', 'ABZORB® cushioning in the midfoot, provides exceptional shock absorption, Blown rubber forefoot, C-CAP® midsole, provides cushioning and support, Leather upper', 130, 1, 'images/nb_999.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `s_user`
--

CREATE TABLE `s_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(88) COLLATE utf8_unicode_ci NOT NULL,
  `user_salt` varchar(23) COLLATE utf8_unicode_ci NOT NULL,
  `user_role` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `s_user`
--

INSERT INTO `s_user` (`user_id`, `user_name`, `user_password`, `user_salt`, `user_role`) VALUES
(1, 'JohnDoe', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER'),
(2, 'JaneDoe', 'EfakNLxyhHy2hVJlxDmVNl1pmgjUZl99gtQ+V3mxSeD8IjeZJ8abnFIpw9QNahwAlEaXBiQUBLXKWRzOmSr8HQ==', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER'),
(3, 'admin', 'gqeuP4YJ8hU3ZqGwGikB6+rcZBqefVy+7hTLQkOD+jwVkp4fkS7/gr1rAQfn9VUKWc7bvOD7OsXrQQN5KGHbfg==', 'EDDsl&fBCJB|a5XUtAlnQN8', 'ROLE_ADMIN'),
(6, 'Lucas', 'b01Dk5ioAcm+8aQx+y8IUknhwMG9KRz1V7efEtczV1zOhJ4YQrDGCok+QH9ymopZ8yRtG66hQGx/Vjk2fO6/ig==', 'a7e0f01c97a0a4aba10d331', 'ROLE_ADMIN');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `s_bag`
--
ALTER TABLE `s_bag`
  ADD PRIMARY KEY (`bag_id`),
  ADD KEY `fk_product_id` (`bag_prod`),
  ADD KEY `fk_user_id` (`bag_user`);

--
-- Index pour la table `s_category`
--
ALTER TABLE `s_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Index pour la table `s_product`
--
ALTER TABLE `s_product`
  ADD PRIMARY KEY (`prod_id`),
  ADD KEY `fk_category` (`prod_cat`);

--
-- Index pour la table `s_user`
--
ALTER TABLE `s_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `s_bag`
--
ALTER TABLE `s_bag`
  MODIFY `bag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `s_category`
--
ALTER TABLE `s_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `s_product`
--
ALTER TABLE `s_product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `s_user`
--
ALTER TABLE `s_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `s_bag`
--
ALTER TABLE `s_bag`
  ADD CONSTRAINT `fk_product_id` FOREIGN KEY (`bag_prod`) REFERENCES `s_product` (`prod_id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`bag_user`) REFERENCES `s_user` (`user_id`);

--
-- Contraintes pour la table `s_product`
--
ALTER TABLE `s_product`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`prod_cat`) REFERENCES `s_category` (`cat_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
