-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 10 juin 2026 à 23:00
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `artilink`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `ID` int(11) NOT NULL,
  `realisation_id` int(11) NOT NULL,
  `note` float NOT NULL,
  `commentaire` text NOT NULL,
  `date_avis` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `demande`
--

CREATE TABLE `demande` (
  `ID` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `prestataire_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `budjet` decimal(10,0) NOT NULL,
  `longitude` decimal(10,0) NOT NULL,
  `latitude` decimal(10,0) NOT NULL,
  `statut` enum('en_attente','accceptee','refusee','annulee') NOT NULL DEFAULT 'en_attente',
  `date_de_creation` date NOT NULL DEFAULT current_timestamp(),
  `date_souhaitee` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `ID` int(11) NOT NULL,
  `expediteur_id` int(11) NOT NULL,
  `destinataire_id` int(11) NOT NULL,
  `type` enum('text','image','video','audio') NOT NULL,
  `contenu` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photo_demande`
--

CREATE TABLE `photo_demande` (
  `ID` int(11) NOT NULL,
  `demande_id` int(11) NOT NULL,
  `lien_photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `photo_realisation`
--

CREATE TABLE `photo_realisation` (
  `ID` int(11) NOT NULL,
  `realisation_id` int(11) NOT NULL,
  `lien_photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `prestataire`
--

CREATE TABLE `prestataire` (
  `ID` int(11) NOT NULL,
  `specialite` varchar(50) NOT NULL,
  `longitude` decimal(11,0),
  `latitude` decimal(11,0),
  `ville` varchar(50) NOT NULL,
  `note_moyenne` decimal(11,0) NOT NULL DEFAULT 0,
  `disponibilite` enum('disponible','pas disponible','en congé') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `realisation`
--

CREATE TABLE `realisation` (
  `ID` int(11) NOT NULL,
  `demande_id` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `statut` enum('en_attente','en_cours','termine','annule') NOT NULL DEFAULT 'en_attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `ID` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `date_de_creation` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `realisation_id` (`realisation_id`);

--
-- Index pour la table `demande`
--
ALTER TABLE `demande`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idClient` (`client_id`),
  ADD KEY `idPrestataire` (`prestataire_id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD KEY `destinataire_id` (`destinataire_id`),
  ADD KEY `expediteur_id` (`expediteur_id`);

--
-- Index pour la table `photo_demande`
--
ALTER TABLE `photo_demande`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `demande_id` (`demande_id`);

--
-- Index pour la table `photo_realisation`
--
ALTER TABLE `photo_realisation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `realisation_id` (`realisation_id`);

--
-- Index pour la table `prestataire`
--
ALTER TABLE `prestataire`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `realisation`
--
ALTER TABLE `realisation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `idDemande` (`demande_id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demande`
--
ALTER TABLE `demande`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `photo_demande`
--
ALTER TABLE `photo_demande`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `photo_realisation`
--
ALTER TABLE `photo_realisation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `prestataire`
--
ALTER TABLE `prestataire`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `realisation`
--
ALTER TABLE `realisation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`realisation_id`) REFERENCES `realisation` (`ID`);

--
-- Contraintes pour la table `demande`
--
ALTER TABLE `demande`
  ADD CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `utilisateur` (`ID`),
  ADD CONSTRAINT `demande_ibfk_2` FOREIGN KEY (`prestataire_id`) REFERENCES `prestataire` (`ID`);

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`destinataire_id`) REFERENCES `utilisateur` (`ID`),
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`expediteur_id`) REFERENCES `utilisateur` (`ID`);

--
-- Contraintes pour la table `photo_demande`
--
ALTER TABLE `photo_demande`
  ADD CONSTRAINT `photo_demande_ibfk_1` FOREIGN KEY (`demande_id`) REFERENCES `demande` (`ID`);

--
-- Contraintes pour la table `photo_realisation`
--
ALTER TABLE `photo_realisation`
  ADD CONSTRAINT `photo_realisation_ibfk_1` FOREIGN KEY (`realisation_id`) REFERENCES `realisation` (`ID`);

--
-- Contraintes pour la table `prestataire`
--
ALTER TABLE `prestataire`
  ADD CONSTRAINT `prestataire_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `utilisateur` (`ID`);

--
-- Contraintes pour la table `realisation`
--
ALTER TABLE `realisation`
  ADD CONSTRAINT `realisation_ibfk_1` FOREIGN KEY (`demande_id`) REFERENCES `demande` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
