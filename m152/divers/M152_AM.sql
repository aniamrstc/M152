-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 30 mars 2023 à 16:46
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
  `marque` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `flash` varchar(100) DEFAULT NULL,
  `datePriseDeVue` varchar(100) DEFAULT NULL,
  `idPost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `MEDIA`
--

INSERT INTO `MEDIA` (`idMedia`, `typeMedia`, `nomMedia`, `creationDate`, `marque`, `model`, `flash`, `datePriseDeVue`, `idPost`) VALUES
(924, 'image/png', 'javascript_64259f554806d.png', '2023-03-30 14:40:21', '', '', '', '', 590),
(925, 'video/mp4', '6 3e4ffe7482884.80244378_64259f61267d5.mp4', '2023-03-30 14:40:33', '', '', '', '', 591),
(926, 'image/png', '6 étapes_64259f612a81d.png', '2023-03-30 14:40:33', '', '', '', '', 591),
(927, 'audio/mpeg', 'Bruit sirène police_64259f613ef43.mp3', '2023-03-30 14:40:33', '', '', '', '', 591),
(928, 'video/mp4', '6 3e4ffe7482884.80244378_64259f767e9a8.mp4', '2023-03-30 14:40:54', '', '', '', '', 592),
(930, 'audio/mpeg', 'Bruit sirène police_64259f7693716.mp3', '2023-03-30 14:40:54', '', '', '', '', 592),
(931, 'video/mp4', '6 3e4ffe7482884.80244378_64259f7d43d07.mp4', '2023-03-30 14:41:01', '', '', '', '', 593),
(948, 'image/png', 'lilianaAppartpng_6425a097ab716.png', '2023-03-30 14:45:43', '800', '800', '12360', '8', 592);

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
(590, 'image', '2023-03-30 14:40:21', '2023-03-30 14:40:21'),
(591, 'multimedia', '2023-03-30 14:40:33', '2023-03-30 14:40:33'),
(592, 'multimedia', '2023-03-30 14:40:54', '2023-03-30 14:40:54'),
(593, 'multimedia', '2023-03-30 14:41:01', '2023-03-30 14:41:01');

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
  MODIFY `idMedia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=949;

--
-- AUTO_INCREMENT pour la table `POST`
--
ALTER TABLE `POST`
  MODIFY `idPost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=601;

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
