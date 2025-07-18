-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 18 juil. 2025 à 02:42
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
  `statut_matrimonial` varchar(20) DEFAULT NULL,
  `pays_origine` varchar(100) DEFAULT NULL,
  `pays_residence` varchar(100) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `ville_residence` varchar(100) DEFAULT NULL,
  `telephone1` varchar(20) DEFAULT NULL,
  `telephone2` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT '0',
  `email` varchar(100) DEFAULT NULL,
  `diplome_obtenu` varchar(255) DEFAULT NULL,
  `institut` varchar(255) DEFAULT NULL,
  `specialite_diplome` varchar(255) DEFAULT NULL,
  `annee_diplome` int DEFAULT NULL,
  `statut_actuel` varchar(100) DEFAULT NULL,
  `employeur` varchar(100) DEFAULT NULL,
  `adresse_employeur2` varchar(255) DEFAULT NULL,
  `tel_employeur` varchar(20) DEFAULT NULL,
  `moyen_connaissance` varchar(100) DEFAULT NULL,
  `engagement_nom` varchar(100) DEFAULT NULL,
  `mode_paiement` varchar(50) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `date_inscription` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `statut` enum('postulant','candidat') NOT NULL DEFAULT 'postulant',
  `indicatif1` varchar(10) DEFAULT NULL,
  `indicatif2` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `candidats`
--

INSERT INTO `candidats` (`id`, `numero_candidat`, `specialite`, `type_etude`, `premiere_langue`, `civilite`, `nom`, `prenom`, `epouse`, `date_naissance`, `lieu_naissance`, `region`, `departement`, `statut_matrimonial`, `pays_origine`, `pays_residence`, `adresse`, `ville_residence`, `telephone1`, `telephone2`, `email`, `diplome_obtenu`, `institut`, `specialite_diplome`, `annee_diplome`, `statut_actuel`, `employeur`, `adresse_employeur2`, `tel_employeur`, `moyen_connaissance`, `engagement_nom`, `mode_paiement`, `photo`, `date_inscription`, `statut`, `indicatif1`, `indicatif2`) VALUES
(1, 'P13025-47', 'Economie Publique et Gestion Publique', 'Distanciel', 'Français', 'M.', 'Kouedi Kouedi', 'Gaitan Emmanuel', 'Kouedi', '2000-08-07', 'DOUALA', 'ADAMAOUA', 'Djérem', 'Célibataire', 'CM', 'CM', 'akwa boulevard de la république', 'DOUALA', '658956855', '', 'g.kouedi90@gmail.com', '2222222', 'IUC', '5555555555', 2000, 'Etudiant', 'YYYYY', 'Nouvelle route Nkolbisson', '658956855', 'Réseaux sociaux', 'KOUEDI GAITAN', 'Especes', 'uploads/6879b279acbc3.png', '2025-07-18 02:33:29', 'postulant', '+237', '+237');

--
-- Déclencheurs `candidats`
--
DROP TRIGGER IF EXISTS `set_candidate_number`;
DELIMITER $$
CREATE TRIGGER `set_candidate_number` BEFORE INSERT ON `candidats` FOR EACH ROW BEGIN
    SET NEW.numero_candidat = CONCAT('P13025-', (SELECT AUTO_INCREMENT 
                                                FROM information_schema.TABLES 
                                                WHERE TABLE_SCHEMA = DATABASE() 
                                                AND TABLE_NAME = 'candidats'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `departement` varchar(50) NOT NULL DEFAULT '',
  `cheflieu` varchar(100) DEFAULT NULL,
  `region` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`departement`),
  KEY `region` (`region`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`departement`, `cheflieu`, `region`) VALUES
('AUTRES', '', 'Z AUTRES'),
('Bamboutos', 'Mbouda\r', 'OUEST'),
('Bénoué', 'Garoua\r', 'NORD'),
('Boumba-et-Ngoko', 'Yokadouma\r', 'EST'),
('Boyo', 'Fundong\r', 'NORD-OUEST'),
('Bui', 'Kumbo\r', 'NORD-OUEST'),
('Diamaré', 'Maroua\r', 'EXTREME-NORD'),
('Dja-et-Lobo', 'Sangmélima\r', 'SUD'),
('Djérem', 'Tibati\r', 'ADAMAOUA'),
('Donga-Mantung', 'Nkambé\r', 'NORD-OUEST'),
('Fako', 'Limbé\r', 'SUD-OUEST'),
('Faro', 'Poli\r', 'NORD'),
('Faro-et-Déo', 'Tignère\r', 'ADAMAOUA'),
('Haut-Nkam', 'Bafang\r', 'OUEST'),
('Haut-Nyong', 'Abong-Mbang\r', 'EST'),
('Haute-Sanaga', 'Nanga-Eboko\r', 'CENTRE'),
('Hauts-Plateaux', 'Baham\r', 'OUEST'),
('Kadey', 'Batouri\r', 'EST'),
('Koung-Khi', 'Bandjoun\r', 'OUEST'),
('Koupé-Manengouba', 'Bangem\r', 'SUD-OUEST'),
('Lebialem', 'Menji\r', 'SUD-OUEST'),
('Lekié', 'Monatele\r', 'CENTRE'),
('Logone-et-Chari', 'Kousséri\r', 'EXTREME-NORD'),
('Lom-et-Djérem', 'Bertoua\r', 'EST'),
('Manyu', 'Mamfé\r', 'SUD-OUEST'),
('Mayo-Banyo', 'Banyo\r', 'ADAMAOUA'),
('Mayo-Danay', 'Yagoua\r', 'EXTREME-NORD'),
('Mayo-Kani', 'Kaélé\r', 'EXTREME-NORD'),
('Mayo-Louti', 'Guider\r', 'NORD'),
('Mayo-Rey', 'Tchollire\r', 'NORD'),
('Mayo-Sava', 'Mora\r', 'EXTREME-NORD'),
('Mayo-Tsanaga', 'Mokolo\r', 'EXTREME-NORD'),
('Mbam-et-Inoubou', 'Bafia\r', 'CENTRE'),
('Mbam-et-Kim', 'Ntui\r', 'CENTRE'),
('Mbéré', 'Meiganga\r', 'ADAMAOUA'),
('Méfou-et-Afamba', 'Mfou\r', 'CENTRE'),
('Méfou-et-Akono', 'Ngoumou\r', 'CENTRE'),
('Meme', 'Kumba\r', 'SUD-OUEST'),
('Menchum', 'Wum\r', 'NORD-OUEST'),
('Menoua', 'Dschang\r', 'OUEST'),
('Mezam', 'Bamenda\r', 'NORD-OUEST'),
('Mfoundi', 'Yaoundé\r', 'CENTRE'),
('Mifi', 'Bafoussam\r', 'OUEST'),
('Momo', 'Mbengwi\r', 'NORD-OUEST'),
('Moungo', 'Nkongsamba', 'LITTORAL'),
('Mvila', 'Ebolowa\r', 'SUD'),
('Ndé', 'Bangangté\r', 'OUEST'),
('Ndian', 'Mudemba\r', 'SUD-OUEST'),
('Ngo-Ketunjia', 'Ndop\r', 'NORD-OUEST'),
('Nkam', NULL, 'LITTORAL'),
('Noun', 'Foumban\r', 'OUEST'),
('Nyong-et-Kellé', 'Éséka\r', 'CENTRE'),
('Nyong-et-Mfoumou', 'Akonolinga\r', 'CENTRE'),
('Nyong-et-So\'o', 'Mbalmayo\r', 'CENTRE'),
('Océan', 'Kribi\r', 'SUD'),
('Sanaga-maritime', '', 'LITTORAL'),
('Vallée-du-Ntem', 'Ambam\r', 'SUD'),
('Vina', 'Ngaoundéré\r', 'ADAMAOUA'),
('Wouri', '', 'LITTORAL');

-- --------------------------------------------------------

--
-- Structure de la table `pays`
--

DROP TABLE IF EXISTS `pays`;
CREATE TABLE IF NOT EXISTS `pays` (
  `code_iso` varchar(2) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `indicatif` varchar(10) NOT NULL,
  PRIMARY KEY (`code_iso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `pays`
--

INSERT INTO `pays` (`code_iso`, `nom`, `indicatif`) VALUES
('AD', 'Andorre', '+376'),
('AE', 'Émirats arabes unis', '+971'),
('AF', 'Afghanistan', '+93'),
('AG', 'Antigua-et-Barbuda', '+1'),
('AL', 'Albanie', '+355'),
('AM', 'Arménie', '+374'),
('AO', 'Angola', '+244'),
('AR', 'Argentine', '+54'),
('AT', 'Autriche', '+43'),
('AU', 'Australie', '+61'),
('AZ', 'Azerbaïdjan', '+994'),
('BA', 'Bosnie-Herzégovine', '+387'),
('BB', 'Barbade', '+1'),
('BD', 'Bangladesh', '+880'),
('BE', 'Belgique', '+32'),
('BF', 'Burkina Faso', '+226'),
('BG', 'Bulgarie', '+359'),
('BH', 'Bahreïn', '+973'),
('BI', 'Burundi', '+257'),
('BJ', 'Bénin', '+229'),
('BN', 'Brunei', '+673'),
('BO', 'Bolivie', '+591'),
('BR', 'Brésil', '+55'),
('BS', 'Bahamas', '+1'),
('BT', 'Bhoutan', '+975'),
('BW', 'Botswana', '+267'),
('BY', 'Bélarus', '+375'),
('BZ', 'Belize', '+501'),
('CA', 'Canada', '+1'),
('CD', 'République Démocratique du Congo', '+243'),
('CF', 'République Centrafricaine', '+236'),
('CG', 'Congo', '+242'),
('CH', 'Suisse', '+41'),
('CI', 'Côte d\'Ivoire', '+225'),
('CL', 'Chili', '+56'),
('CM', 'Cameroun', '+237'),
('CN', 'Chine', '+86'),
('CO', 'Colombie', '+57'),
('CR', 'Costa Rica', '+506'),
('CU', 'Cuba', '+53'),
('CV', 'Cap-Vert', '+238'),
('CY', 'Chypre', '+357'),
('DE', 'Allemagne', '+49'),
('DJ', 'Djibouti', '+253'),
('DK', 'Danemark', '+45'),
('DM', 'Dominique', '+1'),
('DO', 'République Dominicaine', '+1'),
('DZ', 'Algérie', '+213'),
('EC', 'Équateur', '+593'),
('EE', 'Estonie', '+372'),
('EG', 'Égypte', '+20'),
('ER', 'Érythrée', '+291'),
('ES', 'Espagne', '+34'),
('ET', 'Éthiopie', '+251'),
('FI', 'Finlande', '+358'),
('FJ', 'Fidji', '+679'),
('FM', 'Micronésie', '+691'),
('FR', 'France', '+33'),
('GA', 'Gabon', '+241'),
('GB', 'Royaume-Uni', '+44'),
('GD', 'Grenade', '+1'),
('GE', 'Géorgie', '+995'),
('GH', 'Ghana', '+233'),
('GM', 'Gambie', '+220'),
('GN', 'Guinée', '+224'),
('GQ', 'Guinée Équatoriale', '+240'),
('GR', 'Grèce', '+30'),
('GT', 'Guatemala', '+502'),
('GW', 'Guinée-Bissau', '+245'),
('GY', 'Guyana', '+592'),
('HN', 'Honduras', '+504'),
('HR', 'Croatie', '+385'),
('HT', 'Haïti', '+509'),
('HU', 'Hongrie', '+36'),
('ID', 'Indonésie', '+62'),
('IE', 'Irlande', '+353'),
('IL', 'Israël', '+972'),
('IN', 'Inde', '+91'),
('IQ', 'Irak', '+964'),
('IR', 'Iran', '+98'),
('IS', 'Islande', '+354'),
('IT', 'Italie', '+39'),
('JM', 'Jamaïque', '+1'),
('JO', 'Jordanie', '+962'),
('JP', 'Japon', '+81'),
('KE', 'Kenya', '+254'),
('KG', 'Kirghizistan', '+996'),
('KH', 'Cambodge', '+855'),
('KI', 'Kiribati', '+686'),
('KM', 'Comores', '+269'),
('KN', 'Saint-Christophe-et-Niévès', '+1'),
('KP', 'Corée du Nord', '+850'),
('KR', 'Corée du Sud', '+82'),
('KW', 'Koweït', '+965'),
('KZ', 'Kazakhstan', '+7'),
('LA', 'Laos', '+856'),
('LB', 'Liban', '+961'),
('LC', 'Sainte-Lucie', '+1'),
('LI', 'Liechtenstein', '+423'),
('LK', 'Sri Lanka', '+94'),
('LR', 'Libéria', '+231'),
('LS', 'Lesotho', '+266'),
('LT', 'Lituanie', '+370'),
('LU', 'Luxembourg', '+352'),
('LV', 'Lettonie', '+371'),
('LY', 'Libye', '+218'),
('MA', 'Maroc', '+212'),
('MC', 'Monaco', '+377'),
('MD', 'Moldavie', '+373'),
('ME', 'Monténégro', '+382'),
('MG', 'Madagascar', '+261'),
('MH', 'Îles Marshall', '+692'),
('MK', 'Macédoine du Nord', '+389'),
('ML', 'Mali', '+223'),
('MM', 'Myanmar (Birmanie)', '+95'),
('MN', 'Mongolie', '+976'),
('MR', 'Mauritanie', '+222'),
('MT', 'Malte', '+356'),
('MU', 'Maurice', '+230'),
('MV', 'Maldives', '+960'),
('MW', 'Malawi', '+265'),
('MX', 'Mexique', '+52'),
('MY', 'Malaisie', '+60'),
('MZ', 'Mozambique', '+258'),
('NA', 'Namibie', '+264'),
('NE', 'Niger', '+227'),
('NG', 'Nigéria', '+234'),
('NI', 'Nicaragua', '+505'),
('NL', 'Pays-Bas', '+31'),
('NO', 'Norvège', '+47'),
('NP', 'Népal', '+977'),
('NR', 'Nauru', '+674'),
('NZ', 'Nouvelle-Zélande', '+64'),
('OM', 'Oman', '+968'),
('PA', 'Panama', '+507'),
('PE', 'Pérou', '+51'),
('PG', 'Papouasie-Nouvelle-Guinée', '+675'),
('PH', 'Philippines', '+63'),
('PK', 'Pakistan', '+92'),
('PL', 'Pologne', '+48'),
('PT', 'Portugal', '+351'),
('PW', 'Palaos', '+680'),
('PY', 'Paraguay', '+595'),
('QA', 'Qatar', '+974'),
('RO', 'Roumanie', '+40'),
('RS', 'Serbie', '+381'),
('RU', 'Russie', '+7'),
('RW', 'Rwanda', '+250'),
('SA', 'Arabie Saoudite', '+966'),
('SB', 'Îles Salomon', '+677'),
('SC', 'Seychelles', '+248'),
('SD', 'Soudan', '+249'),
('SE', 'Suède', '+46'),
('SG', 'Singapour', '+65'),
('SI', 'Slovénie', '+386'),
('SK', 'Slovaquie', '+421'),
('SL', 'Sierra Leone', '+232'),
('SM', 'Saint-Marin', '+378'),
('SN', 'Sénégal', '+221'),
('SO', 'Somalie', '+252'),
('SR', 'Suriname', '+597'),
('SS', 'Soudan du Sud', '+211'),
('ST', 'Sao Tomé-et-Principe', '+239'),
('SV', 'Salvador', '+503'),
('SY', 'Syrie', '+963'),
('SZ', 'Eswatini', '+268'),
('TD', 'Tchad', '+235'),
('TG', 'Togo', '+228'),
('TH', 'Thaïlande', '+66'),
('TJ', 'Tadjikistan', '+992'),
('TL', 'Timor oriental', '+670'),
('TM', 'Turkménistan', '+993'),
('TN', 'Tunisie', '+216'),
('TO', 'Tonga', '+676'),
('TR', 'Turquie', '+90'),
('TT', 'Trinité-et-Tobago', '+1'),
('TV', 'Tuvalu', '+688'),
('TW', 'Taïwan', '+886'),
('TZ', 'Tanzanie', '+255'),
('UA', 'Ukraine', '+380'),
('UG', 'Ouganda', '+256'),
('US', 'États-Unis', '+1'),
('UY', 'Uruguay', '+598'),
('UZ', 'Ouzbékistan', '+998'),
('VA', 'Vatican', '+379'),
('VC', 'Saint-Vincent-et-les-Grenadines', '+1'),
('VE', 'Venezuela', '+58'),
('VN', 'Vietnam', '+84'),
('VU', 'Vanuatu', '+678'),
('WS', 'Samoa', '+685'),
('XK', 'Kosovo', '+383'),
('YE', 'Yémen', '+967'),
('ZA', 'Afrique du Sud', '+27'),
('ZM', 'Zambie', '+260'),
('ZW', 'Zimbabwe', '+263');

-- --------------------------------------------------------

--
-- Structure de la table `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `Region` varchar(20) NOT NULL DEFAULT '',
  `quota` float DEFAULT NULL,
  `ChefLieu` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Region`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `region`
--

INSERT INTO `region` (`Region`, `quota`, `ChefLieu`) VALUES
('ADAMAOUA', 0.05, ''),
('CENTRE', 0.15, ''),
('EST', 0.04, ''),
('EXTREME-NORD', 0.18, ''),
('LITTORAL', 0.12, ''),
('NORD', 0.07, ''),
('NORD-OUEST', 0.12, ''),
('OUEST', 0.13, ''),
('SUD', 0.04, ''),
('SUD-OUEST', 0.08, ''),
('Z AUTRES', 1, '');

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
(1, 'P13025-47', '$2y$10$n7AyvJ/H.3eLBT995y7QPe26wgHxUHe1ik/PiAl4KpwOVZnB55Uxe', 'candidat', 1, '2025-07-18 02:34:36');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `region` FOREIGN KEY (`region`) REFERENCES `region` (`Region`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
