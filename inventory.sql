-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Dim 12 Mars 2017 à 19:28
-- Version du serveur :  5.5.42
-- Version de PHP :  7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `inventory`
--

-- --------------------------------------------------------

--
-- Structure de la table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `currency` varchar(60) NOT NULL,
  `conversion` float NOT NULL,
  `used` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `currency`
--

INSERT INTO `currency` (`id`, `currency`, `conversion`, `used`) VALUES
(1, 'euros', 1, ',16'),
(2, 'dollars', 1.05, ',17'),
(3, 'yens', 122.51, ''),
(4, 'pounds', 0.88, ''),
(5, 'australian dollars', 1.42, ''),
(6, 'swiss franc', 1.07, ''),
(7, 'canadian dollars', 1.44, ''),
(8, 'pesos', 20.93, ''),
(9, 'yuans', 7.38, ''),
(10, 'new zealand dollars', 1.54, '');

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `pastry` varchar(60) NOT NULL,
  `country` char(255) NOT NULL,
  `photo` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `description` text NOT NULL,
  `user` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `items`
--

INSERT INTO `items` (`id`, `pastry`, `country`, `photo`, `quantity`, `price`, `description`, `user`) VALUES
(118, 'Pain au chocolat', 'France', 'Pain au chocolatFrance.jpg', 5, 2, 'Type of viennoiserie sweet roll consisting of a cuboid-shaped piece of yeast-leavened laminated dough, similar in texture to a puff pastry, with one or two pieces of dark chocolate in the centre.', '16'),
(119, 'Macaroon', 'Carribean Islands', 'MacaroonCarribean Islands.jpg', 2, 1, 'Type of small circular cake, typically made from ground almonds (the original main ingredient[1]), coconut, and/or other nuts or even potato, with sugar, egg white, and sometimes flavorings (e.g. honey, vanilla, spices), food coloring, glace cherries, jam and/or a chocolate coating.', '16'),
(120, 'Banh Bao', 'Vietnam', 'Banh BaoVietnam.jpg', 5, 1.5, 'Ball-shaped bun containing pork or chicken meat, onions, eggs, mushrooms and vegetables, in Vietnamese cuisine. It often has Chinese sausage and a portion of a hard-boiled egg inside', '16'),
(121, 'Palmier', 'Algeria', 'PalmierAlgeria.jpg', 6, 3, 'French Algerian pastry in a palm leaf shape or a butterfly shape, sometimes called palm leaves, cÅ“ur de France, French hearts, shoe-soles, jalebi or glasses.', '17'),
(122, 'Blackberry Pie', 'United States', 'Blackberry PieUnited States.jpg', 4, 6, 'Pie composed of blackberry filling, usually in the form of either blackberry jam, actual blackberries themselves, or some combination thereof', '17'),
(123, 'Danish pastry', 'Denmark', 'Danish pastryDenmark.jpg', 2, 7, 'Multilayered, laminated sweet pastry in the viennoiserie tradition', '17');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` char(255) NOT NULL,
  `lname` char(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` char(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `name`, `password`) VALUES
(16, 'Bruno', 'Simon', 'root', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785'),
(17, 'Bruno', 'Simon', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
