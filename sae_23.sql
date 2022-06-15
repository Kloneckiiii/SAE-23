-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 15 juin 2022 à 20:00
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sae23`
--

-- --------------------------------------------------------

--
-- Structure de la table `administration`
--

CREATE TABLE `administration` (
  `id_admin` int(11) NOT NULL,
  `lgin` text NOT NULL,
  `mot_de_passe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `batiment`
--

CREATE TABLE `batiment` (
  `id_bat` int(11) NOT NULL,
  `Nom` text NOT NULL,
  `login` text NOT NULL,
  `mdp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `batiment`
--

INSERT INTO `batiment` (`id_bat`, `Nom`, `login`, `mdp`) VALUES
(1, 'bate1', 'eliott', 12345),
(2, 'bate2', 'eliott', 12345);

-- --------------------------------------------------------

--
-- Structure de la table `capteur`
--

CREATE TABLE `capteur` (
  `id_capteur` int(11) NOT NULL,
  `salle` text NOT NULL,
  `Nom` text NOT NULL,
  `type` text NOT NULL,
  `batiment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `capteur`
--

INSERT INTO `capteur` (`id_capteur`, `salle`, `Nom`, `type`, `batiment`) VALUES
(1, 'E101', 'E101_temp', 'temperature', 1),
(2, 'E101', 'E101_lum', 'luminosite', 1),
(3, 'E102', 'E102_temp', 'temperature', 1),
(4, 'E102', 'E102_lum', 'luminosite', 1),
(5, 'E201', 'E201_temp', 'temperature', 2),
(6, 'E201', 'E201_lum', 'luminosite', 2),
(7, 'E202', 'E202_temp', 'temperature', 2),
(8, 'E202', 'E202_lum', 'luminosite', 2);

-- --------------------------------------------------------

--
-- Structure de la table `mesure`
--

CREATE TABLE `mesure` (
  `id_mesure` int(11) NOT NULL,
  `date/heure` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_capteur` int(11) NOT NULL,
  `valeur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `mesure`
--

INSERT INTO `mesure` (`id_mesure`, `date/heure`, `id_capteur`, `valeur`) VALUES
(1, '2022-06-15 08:58:39', 1, 21),
(2, '2022-06-15 17:13:43', 1, 25),
(3, '2022-06-15 17:13:48', 2, 68),
(4, '2022-06-15 17:17:03', 1, 25),
(5, '2022-06-15 17:17:08', 2, 46),
(6, '2022-06-15 17:17:13', 3, 23),
(7, '2022-06-15 17:17:18', 4, 69),
(8, '2022-06-15 17:17:23', 5, 23),
(9, '2022-06-15 17:20:24', 1, 25),
(10, '2022-06-15 17:20:29', 2, 69),
(11, '2022-06-15 17:20:34', 3, 22),
(12, '2022-06-15 17:21:14', 1, 25),
(13, '2022-06-15 17:21:19', 2, 66),
(14, '2022-06-15 17:21:24', 3, 23),
(15, '2022-06-15 17:21:29', 4, 69),
(16, '2022-06-15 17:21:34', 5, 24),
(17, '2022-06-15 17:24:35', 1, 24),
(18, '2022-06-15 17:24:40', 2, 61),
(19, '2022-06-15 17:24:45', 3, 24),
(20, '2022-06-15 17:24:50', 4, 60),
(21, '2022-06-15 17:24:55', 5, 23),
(22, '2022-06-15 17:36:00', 1, 24),
(23, '2022-06-15 17:36:10', 2, 66),
(24, '2022-06-15 17:36:20', 3, 20),
(25, '2022-06-15 17:36:30', 4, 78),
(26, '2022-06-15 17:36:40', 5, 19),
(27, '2022-06-15 17:58:51', 1, 25),
(28, '2022-06-15 17:58:53', 2, 53),
(29, '2022-06-15 17:58:55', 3, 23),
(30, '2022-06-15 17:58:57', 4, 64),
(31, '2022-06-15 17:58:59', 5, 25),
(32, '2022-06-15 17:59:01', 6, 62),
(33, '2022-06-15 17:59:03', 7, 23),
(34, '2022-06-15 17:59:05', 8, 45),
(35, '2022-06-15 18:00:09', 1, 24),
(36, '2022-06-15 18:00:11', 2, 59),
(37, '2022-06-15 18:00:13', 3, 22),
(38, '2022-06-15 18:00:15', 4, 51),
(39, '2022-06-15 18:00:17', 5, 25),
(40, '2022-06-15 18:00:19', 6, 68),
(41, '2022-06-15 18:00:21', 7, 22),
(42, '2022-06-15 18:00:23', 8, 48);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administration`
--
ALTER TABLE `administration`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `batiment`
--
ALTER TABLE `batiment`
  ADD PRIMARY KEY (`id_bat`);

--
-- Index pour la table `capteur`
--
ALTER TABLE `capteur`
  ADD PRIMARY KEY (`id_capteur`),
  ADD KEY `id_bat` (`batiment`);

--
-- Index pour la table `mesure`
--
ALTER TABLE `mesure`
  ADD PRIMARY KEY (`id_mesure`),
  ADD KEY `capteur->données` (`id_capteur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administration`
--
ALTER TABLE `administration`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `batiment`
--
ALTER TABLE `batiment`
  MODIFY `id_bat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `capteur`
--
ALTER TABLE `capteur`
  MODIFY `id_capteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `mesure`
--
ALTER TABLE `mesure`
  MODIFY `id_mesure` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `capteur`
--
ALTER TABLE `capteur`
  ADD CONSTRAINT `id_bat` FOREIGN KEY (`batiment`) REFERENCES `batiment` (`id_bat`);

--
-- Contraintes pour la table `mesure`
--
ALTER TABLE `mesure`
  ADD CONSTRAINT `capteur->données` FOREIGN KEY (`id_capteur`) REFERENCES `capteur` (`id_capteur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
