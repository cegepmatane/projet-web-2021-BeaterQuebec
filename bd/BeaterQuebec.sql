-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 24 fév. 2021 à 16:21
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `beaterquebec`
--

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id` int(11) NOT NULL,
  `pseudonyme` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `motDePasse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id`, `pseudonyme`, `nom`, `prenom`, `email`, `admin`, `motDePasse`) VALUES
(6, 'xd', 'xdnom', 'xdprenom', 'xd@hotmail.com', 1, '$2y$10$V1eyRiR/FXhT26qxO0fGEuqaHOrtvXvNiQmEcKxHzO0hXShevAdYG'),
(47, 'Thonio', 'Anto', 'Belan', 'dofman@hotmail.com', 1, '$2y$10$tTPzpZ7MTF5xitGMncKfR.TzB8z0TpBiD3P4NXoOcVCATxwOuGZGm'),
(48, 'test', 'Carrier', 'Charles', 'charlescarrier1337@hotmail.com', 0, '$2y$10$Hv8rWVXAFNaby8/V593ao.SMOQnIxObnMOqMqZTQyvw0H0zMxYN9i');

-- --------------------------------------------------------

--
-- Structure de la table `vendus`
--

CREATE TABLE `vendus` (
  `id` int(11) NOT NULL,
  `fk_voiture` int(11) NOT NULL,
  `fk_membre` int(11) NOT NULL,
  `id_stripe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vendus`
--

INSERT INTO `vendus` (`id`, `fk_voiture`, `fk_membre`, `id_stripe`) VALUES
(26, 8, 47, 'cs_test_a1k12HBVUBHDDVhiElCJ5AqLBwC94bYwQq66jQkRX5DLERBptNkTHhzOuI'),
(27, 9, 47, 'cs_test_a11cb9LdX4AljM67GcAU2auKE8o36BhvaMcxASAS3GgBbaQaG818kRoz2V');

-- --------------------------------------------------------

--
-- Structure de la table `visiteurs`
--

CREATE TABLE `visiteurs` (
  `id` int(11) NOT NULL,
  `user_ip` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  `parametre` varchar(255) NOT NULL,
  `langue` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `visiteurs`
--


-- --------------------------------------------------------

--
-- Structure de la table `voitures`
--

CREATE TABLE `voitures` (
  `id` int(11) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `modele` varchar(255) NOT NULL,
  `annee` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `kilometrages` double NOT NULL DEFAULT 0,
  `prix` int(11) NOT NULL,
  `vendu` tinyint(1) DEFAULT 0,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `voitures`
--

INSERT INTO `voitures` (`id`, `marque`, `modele`, `annee`, `description`, `kilometrages`, `prix`, `vendu`, `image`) VALUES
(8, 'Honda', 'Civic', 2001, 'Surper clean planche pas percer', 353257, 1000, 1, 's-l200.jpg'),
(9, 'Toyota', 'Echo', 2005, 'condition a1 roulle comme une bille', 230419, 1200, 1, '5685366_04850_2005-toyota-echo_001.jpg'),
(11, 'Mitsubishi', 'Lancer', 2000, 'Rally', 150000, 5000, 0, ''),
(12, 'Subaru', 'Impreza', 1998, '', 190000, 10000, 0, ''),
(21, 'Toyota', 'Camry', 1999, 'top shape', 400000, 900, 0, '1999_toyota_camry-pic-3326736620462878141-1024x768.jpeg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vendus`
--
ALTER TABLE `vendus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_voiture_id` (`fk_voiture`),
  ADD KEY `fk_membre_id` (`fk_membre`);

--
-- Index pour la table `visiteurs`
--
ALTER TABLE `visiteurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `voitures`
--
ALTER TABLE `voitures`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `vendus`
--
ALTER TABLE `vendus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `visiteurs`
--
ALTER TABLE `visiteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=351;

--
-- AUTO_INCREMENT pour la table `voitures`
--
ALTER TABLE `voitures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `vendus`
--
ALTER TABLE `vendus`
  ADD CONSTRAINT `fk_membre_id` FOREIGN KEY (`fk_membre`) REFERENCES `membre` (`id`),
  ADD CONSTRAINT `fk_voiture_id` FOREIGN KEY (`fk_voiture`) REFERENCES `voitures` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
