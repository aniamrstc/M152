-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 30 mars 2023 à 11:24
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
  `width` varchar(100) DEFAULT NULL,
  `height` varchar(100) DEFAULT NULL,
  `fileSize` varchar(100) DEFAULT NULL,
  `profondeurCouleur` varchar(100) DEFAULT NULL,
  `idPost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `MEDIA`
--

INSERT INTO `MEDIA` (`idMedia`, `typeMedia`, `nomMedia`, `creationDate`, `width`, `height`, `fileSize`, `profondeurCouleur`, `idPost`) VALUES
(794, 'video/mp4', '6 3e4ffe7482884.80244378_6425506b01d6d.mp4', '2023-03-30 09:03:39', NULL, NULL, '233346', NULL, 549),
(795, 'image/png', 'Bootstrap_logo.svg_64255072c6388.png', '2023-03-30 09:03:46', '800', '800', '67522', '8', 550),
(796, 'audio/mpeg', 'Bruit sirène police_6425507e132f2.mp3', '2023-03-30 09:03:58', NULL, NULL, '511720', NULL, 551),
(797, 'video/mp4', '6 3e4ffe7482884.80244378_64255098580ee.mp4', '2023-03-30 09:04:24', NULL, NULL, '233346', NULL, 552),
(800, 'audio/mpeg', 'Bruit sirène police_6425509882e9e.mp3', '2023-03-30 09:04:24', NULL, NULL, '511720', NULL, 552),
(801, 'image/png', 'javascript_642550988335e.png', '2023-03-30 09:04:24', '800', '800', '30867', '8', 552),
(804, 'video/mp4', '6 3e4ffe7482884.80244378_642550de08d15.mp4', '2023-03-30 09:05:34', NULL, NULL, '233346', NULL, 554),
(805, 'audio/mpeg', 'Bruit sirène police_642550de08fcd.mp3', '2023-03-30 09:05:34', NULL, NULL, '511720', NULL, 554),
(806, 'image/png', 'javascript_642550f3b5f7c.png', '2023-03-30 09:05:55', '800', '800', '30867', '8', 554),
(808, 'image/jpeg', 'RS3-AV_64255126358bf.jpeg', '2023-03-30 09:06:46', '800', '800', '67277', '8', 552),
(909, 'image/png', 'Bootstrap_logo.svg_6425551e37ce7.png', '2023-03-30 09:23:42', '800', '800', '67522', '8', 554);

-- --------------------------------------------------------

--
-- Structure de la table `POST`
--

CREATE TABLE `POST` (
  `idPost` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `modificationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `POST`
--

INSERT INTO `POST` (`idPost`, `commentaire`, `creationDate`, `modificationDate`) VALUES
(549, 'video', '2023-03-30 09:03:39', '2023-03-30 09:03:39'),
(550, 'image', '2023-03-30 09:03:46', '2023-03-30 09:03:46'),
(551, 'audio', '2023-03-30 09:03:58', '2023-03-30 09:03:58'),
(552, 'multi media', '2023-03-30 09:04:24', '2023-03-30 09:04:24'),
(554, 'video+audio+image', '2023-03-30 09:05:34', '2023-03-30 09:13:52');

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
  MODIFY `idMedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=910;

--
-- AUTO_INCREMENT pour la table `POST`
--
ALTER TABLE `POST`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=570;

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
