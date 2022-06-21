-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 21 juin 2022 à 14:57
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bd_sae23`
--

-- --------------------------------------------------------

--
-- Structure de la table `administration`
--

CREATE TABLE `administration` (
  `id_admin` int(11) NOT NULL,
  `login2` text NOT NULL,
  `mot_de_passe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `administration`
--

INSERT INTO `administration` (`id_admin`, `login2`, `mot_de_passe`) VALUES
(1, 'user', 'passroot');

-- --------------------------------------------------------

--
-- Structure de la table `batiment`
--

CREATE TABLE `batiment` (
  `id_bat` int(11) NOT NULL,
  `Nom` text NOT NULL,
  `login2` text NOT NULL,
  `mdp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `batiment`
--

INSERT INTO `batiment` (`id_bat`, `Nom`, `login2`, `mdp`) VALUES
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
(42, '2022-06-15 18:00:23', 8, 48),
(43, '2022-06-15 18:02:46', 1, 21),
(44, '2022-06-15 18:02:48', 2, 76),
(45, '2022-06-15 18:02:50', 3, 21),
(46, '2022-06-15 18:02:52', 4, 63),
(47, '2022-06-15 18:02:54', 5, 22),
(48, '2022-06-15 18:02:56', 6, 59),
(49, '2022-06-15 18:02:58', 7, 23),
(50, '2022-06-15 18:03:00', 8, 58),
(51, '2022-06-15 18:06:40', 1, 20),
(52, '2022-06-15 18:06:45', 2, 46),
(53, '2022-06-15 18:06:50', 3, 18),
(54, '2022-06-15 18:06:55', 4, 67),
(55, '2022-06-15 18:07:00', 5, 24),
(56, '2022-06-15 18:07:05', 6, 61),
(57, '2022-06-15 18:07:10', 7, 24),
(58, '2022-06-15 18:07:15', 8, 78),
(59, '2022-06-15 18:07:30', 1, 20),
(60, '2022-06-15 18:07:35', 2, 49),
(61, '2022-06-15 18:07:40', 3, 18),
(62, '2022-06-15 18:07:45', 4, 59),
(63, '2022-06-15 18:07:50', 5, 24),
(64, '2022-06-15 18:07:55', 6, 67),
(65, '2022-06-15 18:08:00', 7, 25),
(66, '2022-06-15 18:08:05', 8, 80),
(67, '2022-06-18 09:48:56', 2, 23),
(68, '2022-06-18 09:55:30', 3, 54);

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
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `batiment`
--
ALTER TABLE `batiment`
  MODIFY `id_bat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `capteur`
--
ALTER TABLE `capteur`
  MODIFY `id_capteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `mesure`
--
ALTER TABLE `mesure`
  MODIFY `id_mesure` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

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
