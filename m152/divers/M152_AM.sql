-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 29 mars 2023 à 07:56
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
(723, 'video/mp4', '6 3e4ffe7482884.80244378_6423d2b2a1e2b.mp4', '2023-03-29 05:54:58', 402),
(724, 'audio/mpeg', 'Bruit sirène police_6423d2bf62caa.mp3', '2023-03-29 05:55:11', 403),
(725, 'image/png', '6 étapes_6423d2de329c2.png', '2023-03-29 05:55:42', 404),
(726, 'image/png', '35545_GWY_R_6423d2de32b9e.png', '2023-03-29 05:55:42', 404),
(727, 'image/png', '41993_GWY_R_6423d2de36cfc.png', '2023-03-29 05:55:42', 404),
(728, 'image/png', 'Capture_6423d2de36edd.PNG', '2023-03-29 05:55:42', 404),
(729, 'image/png', 'Opera Instantané_2023-03-21_152154_aniamarostica.proto.io_6423d30108cc5.png', '2023-03-29 05:56:17', 405);

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
(402, 'Vidéo', '2023-03-29 05:54:58', '2023-03-29 05:54:58'),
(403, 'audio', '2023-03-29 05:55:11', '2023-03-29 05:55:11'),
(404, 'multimedia\r\n', '2023-03-29 05:55:42', '2023-03-29 05:55:42'),
(405, 'image', '2023-03-29 05:56:17', '2023-03-29 05:56:17');

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
  MODIFY `idMedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=730;

--
-- AUTO_INCREMENT pour la table `POST`
--
ALTER TABLE `POST`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=406;

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
