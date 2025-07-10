-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 10 juil. 2025 à 14:42
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pssfp_candidatures`
--

DELIMITER $$
--
-- Procédures
--
DROP PROCEDURE IF EXISTS `generate_candidate_number`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_candidate_number` (IN `candidate_id` INT)   BEGIN
    UPDATE candidats SET numero_candidat = CONCAT('P13025-', candidate_id) WHERE id = candidate_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `candidats`
--

DROP TABLE IF EXISTS `candidats`;
CREATE TABLE IF NOT EXISTS `candidats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numero_candidat` varchar(20) DEFAULT NULL,
  `specialite` varchar(100) DEFAULT NULL,
  `type_etude` varchar(20) DEFAULT NULL,
  `premiere_langue` varchar(20) DEFAULT NULL,
  `civilite` varchar(10) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `epouse` varchar(100) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `lieu_naissance` varchar(100) DEFAULT NULL,
  `region` varchar(100) DEFAULT NULL,
  `departement` varchar(100) DEFAULT NULL,
  `nationalite` varchar(100) DEFAULT NULL,
  `statut_matrimonial` varchar(20) DEFAULT NULL,
  `nb_enfants` int DEFAULT NULL,
  `pays_origine` varchar(100) DEFAULT NULL,
  `pays_residence` varchar(100) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `ville_residence` varchar(100) DEFAULT NULL,
  `telephone1` varchar(20) DEFAULT NULL,
  `telephone2` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `diplome_obtenu` varchar(255) DEFAULT NULL,
  `institut` varchar(255) DEFAULT NULL,
  `specialite_diplome` varchar(255) DEFAULT NULL,
  `annee_diplome` int DEFAULT NULL,
  `statut_actuel` varchar(100) DEFAULT NULL,
  `employeur` varchar(100) DEFAULT NULL,
  `adresse_employeur2` varchar(255) DEFAULT NULL,
  `tel_employeur` varchar(20) DEFAULT NULL,
  `email_admin` varchar(100) DEFAULT NULL,
  `moyen_connaissance` varchar(100) DEFAULT NULL,
  `engagement_nom` varchar(100) DEFAULT NULL,
  `mode_paiement` varchar(50) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `date_inscription` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `statut` enum('postulant','candidat') NOT NULL DEFAULT 'postulant',
  `indicatif1` varchar(10) DEFAULT NULL,
  `indicatif2` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `candidats`
--

INSERT INTO `candidats` (`id`, `numero_candidat`, `specialite`, `type_etude`, `premiere_langue`, `civilite`, `nom`, `prenom`, `epouse`, `date_naissance`, `lieu_naissance`, `region`, `departement`, `nationalite`, `statut_matrimonial`, `nb_enfants`, `pays_origine`, `pays_residence`, `adresse`, `ville_residence`, `telephone1`, `telephone2`, `email`, `diplome_obtenu`, `institut`, `specialite_diplome`, `annee_diplome`, `statut_actuel`, `employeur`, `adresse_employeur2`, `tel_employeur`, `email_admin`, `moyen_connaissance`, `engagement_nom`, `mode_paiement`, `photo`, `date_inscription`, `statut`, `indicatif1`, `indicatif2`) VALUES
(3, 'P13025-3', 'Finances Publiques', 'Présentiel', 'Français', 'M.', 'Kouedi Kouedi', 'Gaitan Emmanuel', '', '2025-07-01', 'DOUALA', 'LITTORAL', 'WOURI', 'Camerounaise', 'Célibataire', 0, 'Cameroun', 'Cameroun', 'akwa boulevard de la république', 'DOUALA', '658956855', '', 'g.kouedi90@gmail.com', '', '', '', 0, 'CADRE CONTRACTUELLE', '', '', '', '', 'Réseaux sociaux', 'KOUEDI GAITAN', 'Especes', NULL, '2025-07-03 10:06:09', 'postulant', NULL, NULL),
(11, 'P13025-0', 'Economie Publique et Gestion Publique', 'Présentiel', NULL, 'M.', 'Kouedi Kouedi', 'Gaitan Emmanuel', '', '2003-08-07', 'DOUALA', 'LITTORAL', 'WOURI', 'Camerounaise', 'Célibataire', NULL, '', 'Cameroun', 'akwa boulevard de la république', 'DOUALA', '658956855', '', 'g.kouedi90@gmail.com', '', '', '', 0, 'Etudiant', '', '', '', '', 'Réseaux sociaux', 'KOUEDI GAITAN', 'Especes', '686e36a3e0af4_481766760_640202645185954_2728172198382057513_n (1).jpg', '2025-07-09 08:30:11', 'postulant', '+237', ''),
(19, 'P13025-19', 'Economie Publique et Gestion Publique', 'Présentiel', NULL, 'Mme', 'Kouedi Kouedi', 'Gaitan Emmanuel', '', '2003-08-07', 'DOUALA', 'LITTORAL', 'WOURI', 'Camerounaise', 'Célibataire', 0, '', 'Cameroun', 'Nouvelle route Nkolbisson', 'Yaoundé', '+237658956855', NULL, 'g.kouedi90@gmail.com', '', '', '', 0, 'Etudiant', '', '', '', '', 'Réseaux sociaux', 'KOUEDI GAITAN', 'OM/MoMo', '686fd099409e3_z4vFgwzW_400x400j.jpg', '2025-07-10 13:39:21', 'postulant', '+237', '');

--
-- Déclencheurs `candidats`
--
DROP TRIGGER IF EXISTS `set_candidate_number`;
DELIMITER $$
CREATE TRIGGER `set_candidate_number` AFTER INSERT ON `candidats` FOR EACH ROW BEGIN
    UPDATE `candidats` 
    SET `numero_candidat` = CONCAT('P13025-', NEW.id) 
    WHERE `id` = NEW.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('candidat','admin') NOT NULL DEFAULT 'candidat',
  `candidat_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `candidat_id`, `created_at`) VALUES
(1, 'P258105', '$2y$10$ScOXN4JAq2iVTgXDeSQZl.jFFFTaibokM5KrphAOFnZssht9NNlSq', 'candidat', 12, '2025-07-09 09:53:38');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
