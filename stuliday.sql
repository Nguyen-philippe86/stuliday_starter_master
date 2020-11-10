-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 10 nov. 2020 à 14:43
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stuliday`
--
CREATE DATABASE IF NOT EXISTS `stuliday` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `stuliday`;

-- --------------------------------------------------------

--
-- Structure de la table `adverts`
--

CREATE TABLE `adverts` (
  `ad_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `adverts`
--

INSERT INTO `adverts` (`ad_id`, `title`, `description`, `address`, `city`, `price`, `images`, `author`) VALUES
(1, 'appartement 45m2', 'Très bel appartement situé dans le quartier st michel', '9 rue Jean Moulin', 'Bordeaux', 850, NULL, 7),
(3, 'Maison 105m2', 'Très belle maison', '36 rue Henri Boucher', 'Bordeaux', 500000, NULL, 7),
(4, 'Location chambre ', 'Location chambre 15m2', '6 rue Alfred Derouault', 'Bordeaux', 45, NULL, 11),
(10, 'Chambre d\'hôte', '99/nuit', '67 rue Edouard Branly', 'Merignac', 99, NULL, 12);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fullname`) VALUES
(7, 'stuliday@test.fr', '$2y$10$uPhQTWdoTHGXrwUaO.XCU.TE202fb/naBqaf8LhtLP0SpV1GpmdoS', NULL),
(11, 'abc@abc.com', '$2y$10$z2QkYi0giLEvl1aQheeOU.EfUnzhU3oI5zboCkq6UW070ffMA/H/y', NULL),
(12, 'test@test.com', '$2y$10$z/W570XiQbW3EEcQvfXbO.O84l.4coqei6rFDgKe6LAGOxrdqzdKG', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adverts`
--
ALTER TABLE `adverts`
  ADD PRIMARY KEY (`ad_id`),
  ADD KEY `author_fk` (`author`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `adverts`
--
ALTER TABLE `adverts`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adverts`
--
ALTER TABLE `adverts`
  ADD CONSTRAINT `author_fk` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
