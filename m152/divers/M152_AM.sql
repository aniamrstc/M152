-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 02 fév. 2023 à 16:06
-- Version du serveur :  10.3.37-MariaDB-0ubuntu0.20.04.1
-- Version de PHP : 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `M152_AM`
--
CREATE DATABASE IF NOT EXISTS `M152_AM` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `M152_AM`;

-- --------------------------------------------------------

--
-- Structure de la table `MEDIA`
--

CREATE TABLE `MEDIA` (
  `idMedia` int(11) NOT NULL,
  `typeMedia` text NOT NULL,
  `nomMedia` text NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idPost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `MEDIA`
--

INSERT INTO `MEDIA` (`idMedia`, `typeMedia`, `nomMedia`, `creationDate`, `idPost`) VALUES
(2, 'png', 'frac.png', '2023-02-01 23:00:00', 4),
(3, 'png', 'frac.png', '2023-02-01 23:00:00', 5);

-- --------------------------------------------------------

--
-- Structure de la table `POST`
--

CREATE TABLE `POST` (
  `idPost` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modificationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `POST`
--

INSERT INTO `POST` (`idPost`, `commentaire`, `creationDate`, `modificationDate`) VALUES
(1, 'RRRR', '2023-02-01 23:00:00', '2023-02-01 23:00:00'),
(2, 'RRRR', '2023-02-01 23:00:00', '2023-02-01 23:00:00'),
(3, 'RRRR', '2023-02-01 23:00:00', '2023-02-01 23:00:00'),
(4, 'RRRR', '2023-02-01 23:00:00', '2023-02-01 23:00:00'),
(5, 'co', '2023-02-01 23:00:00', '2023-02-01 23:00:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `MEDIA`
--
ALTER TABLE `MEDIA`
  ADD PRIMARY KEY (`idMedia`),
  ADD KEY `MEDIA_ibfk_1` (`idPost`);

--
-- Index pour la table `POST`
--
ALTER TABLE `POST`
  ADD PRIMARY KEY (`idPost`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `MEDIA`
--
ALTER TABLE `MEDIA`
  MODIFY `idMedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `POST`
--
ALTER TABLE `POST`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `MEDIA`
--
ALTER TABLE `MEDIA`
  ADD CONSTRAINT `MEDIA_ibfk_1` FOREIGN KEY (`idPost`) REFERENCES `POST` (`idPost`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
