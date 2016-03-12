-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 12 Mars 2016 à 14:20
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
-- Structure de la table `s_product`
--

CREATE TABLE `s_product` (
  `prod_id` int(11) NOT NULL,
  `prod_title` varchar(100) NOT NULL,
  `prod_desc` varchar(1000) NOT NULL,
  `prod_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `s_product`
--

INSERT INTO `s_product` (`prod_id`, `prod_title`, `prod_desc`, `prod_price`) VALUES
(1, '991 New Balance', 'La chaussure qui a défini New Balance, notre sneaker 991 réalisée en daim et dotée d''un coussin pour un style et confort imbattable.', 185),
(2, '999 Elite Edition Paper Lights', 'ABZORB® cushioning in the midfoot, provides exceptional shock absorption, Blown rubber forefoot, C-CAP® midsole, provides cushioning and support, Leather upper', 130);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `s_product`
--
ALTER TABLE `s_product`
  ADD PRIMARY KEY (`prod_id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `s_product`
--
ALTER TABLE `s_product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
