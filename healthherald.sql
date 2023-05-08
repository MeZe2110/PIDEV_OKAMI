-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2023 at 02:55 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthherald`
--

-- --------------------------------------------------------

--
-- Table structure for table `categoriesequipement`
--

CREATE TABLE `categoriesequipement` (
  `id` int(11) NOT NULL,
  `nomcate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categoriesequipement`
--

INSERT INTO `categoriesequipement` (`id`, `nomcate`) VALUES
(1, 'DIAGNOSTIC SPECIALISE'),
(2, 'DIAGNOSTIC GENERAL'),
(3, 'MOBILIER - EQUIPEMENT DU CABINET'),
(4, 'HYGIENE - PROTECTION'),
(5, 'INSTRUMENTATION - PETIT MATERIEL'),
(6, 'SOINS PANSEMENT INJECTION'),
(7, 'ACCESSOIRES ET PIECES DETACHEES'),
(8, 'VETEMENT ET MALLETTE MEDICALE');

-- --------------------------------------------------------

--
-- Table structure for table `categoriesvehicules`
--

CREATE TABLE `categoriesvehicules` (
  `id` int(11) NOT NULL,
  `typecatv` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categoriesvehicules`
--

INSERT INTO `categoriesvehicules` (`id`, `typecatv`) VALUES
(1, 'Vehicule de catégorie A (ASSU)'),
(2, 'Véhicule de catégorie B (VSAB)'),
(3, 'Véhicule de catégorie C');

-- --------------------------------------------------------

--
-- Table structure for table `disabled_until`
--

CREATE TABLE `disabled_until` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230308035951', '2023-04-11 14:54:11', 1444),
('DoctrineMigrations\\Version20230308035953', '2023-04-11 14:54:12', 17),
('DoctrineMigrations\\Version20230308035954', '2023-04-11 14:54:12', 15),
('DoctrineMigrations\\Version20230308035955', '2023-04-11 14:54:12', 4);

-- --------------------------------------------------------

--
-- Table structure for table `equipement`
--

CREATE TABLE `equipement` (
  `id` int(11) NOT NULL,
  `nomeq` varchar(255) NOT NULL,
  `etateq` tinyint(1) NOT NULL,
  `dispoeq` tinyint(1) NOT NULL,
  `Categoriesequipement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipement`
--

INSERT INTO `equipement` (`id`, `nomeq`, `etateq`, `dispoeq`, `Categoriesequipement`) VALUES
(1, 'Pèse personne mécanique Classe IV', 1, 1, 1),
(2, 'Doigtiers', 1, 0, 4),
(3, 'Ote-agrafes', 1, 1, 5),
(4, 'Sabots', 0, 0, 8),
(5, 'Station murale de diagnostic', 0, 1, 2),
(6, 'Marchepied', 1, 1, 3),
(7, 'Accessoires de diagnostic', 1, 0, 8),
(8, 'Désinfection des surfaces', 1, 1, 4),
(9, 'Electrocardiographe', 1, 1, 1),
(10, 'Tampon alcool 70° injection', 0, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `historique`
--

CREATE TABLE `historique` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plannification`
--

CREATE TABLE `plannification` (
  `id` int(11) NOT NULL,
  `salle` int(11) NOT NULL,
  `datepl` date NOT NULL,
  `heuredebutpl` time NOT NULL,
  `heurefinpl` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plannification`
--

INSERT INTO `plannification` (`id`, `salle`, `datepl`, `heuredebutpl`, `heurefinpl`) VALUES
(1, 1, '2023-03-09', '12:30:00', '15:00:00'),
(2, 3, '2023-03-10', '12:30:00', '16:00:00'),
(3, 1, '2023-03-12', '11:00:00', '12:00:00'),
(4, 7, '2023-03-11', '15:30:00', '17:00:00'),
(5, 5, '2023-03-20', '10:30:00', '12:00:00'),
(6, 3, '2023-03-15', '08:30:00', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rendezvous`
--

CREATE TABLE `rendezvous` (
  `id` int(11) NOT NULL,
  `daterv` datetime NOT NULL DEFAULT current_timestamp(),
  `rappel` tinyint(1) NOT NULL DEFAULT 1,
  `end_at` datetime NOT NULL DEFAULT current_timestamp(),
  `Salle` int(11) NOT NULL,
  `Type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rendezvous`
--

INSERT INTO `rendezvous` (`id`, `daterv`, `rappel`, `end_at`, `Salle`, `Type`) VALUES
(1, '2023-03-09 12:00:00', 1, '2023-03-09 15:00:00', 1, 1),
(2, '2023-03-09 12:00:00', 1, '2023-03-09 15:00:00', 2, 1),
(3, '2023-03-09 12:00:00', 1, '2023-03-09 16:00:00', 3, 3),
(4, '2023-03-09 15:00:00', 1, '2023-03-09 18:00:00', 5, 2),
(5, '2023-03-10 08:30:00', 1, '2023-03-10 12:00:00', 7, 1),
(6, '2023-03-10 08:30:00', 1, '2023-03-10 09:30:00', 3, 3),
(7, '2023-03-10 08:30:00', 1, '2023-03-10 09:30:00', 5, 2),
(8, '2023-03-10 09:30:00', 1, '2023-03-10 12:30:00', 4, 3),
(9, '2023-03-10 15:00:00', 1, '2023-03-10 17:30:00', 6, 5),
(10, '2023-03-12 10:30:00', 1, '2023-03-12 15:00:00', 10, 5),
(11, '2023-03-16 12:00:00', 1, '2023-03-16 13:00:00', 1, 4),
(12, '2023-03-16 12:00:00', 1, '2023-03-16 15:00:00', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rendezvous_type`
--

CREATE TABLE `rendezvous_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rendezvous_type`
--

INSERT INTO `rendezvous_type` (`id`, `type`) VALUES
(1, 'Administratif'),
(2, 'Médical'),
(3, 'Opération'),
(4, 'Informatif'),
(5, 'Autre');

-- --------------------------------------------------------

--
-- Table structure for table `rendezvous_user`
--

CREATE TABLE `rendezvous_user` (
  `rendezvous_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rendezvous_user`
--

INSERT INTO `rendezvous_user` (`rendezvous_id`, `user_id`) VALUES
(1, 1),
(1, 7),
(2, 3),
(2, 4),
(2, 5),
(3, 3),
(3, 7),
(4, 5),
(4, 6),
(5, 1),
(5, 3),
(5, 4),
(5, 5),
(5, 7),
(6, 1),
(6, 7),
(7, 2),
(7, 5),
(7, 6),
(8, 1),
(8, 4),
(8, 7),
(9, 3),
(9, 7),
(10, 3),
(10, 7),
(11, 1),
(11, 6),
(12, 1),
(12, 4),
(12, 7);

-- --------------------------------------------------------

--
-- Table structure for table `reset_password_request`
--

CREATE TABLE `reset_password_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `selector` varchar(20) NOT NULL,
  `hashed_token` varchar(100) NOT NULL,
  `requested_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `expires_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roleuser`
--

CREATE TABLE `roleuser` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roleuser`
--

INSERT INTO `roleuser` (`id`, `role`) VALUES
(1, 'Administrateur'),
(2, 'Employé'),
(3, 'Utilisateur');

-- --------------------------------------------------------

--
-- Table structure for table `salle`
--

CREATE TABLE `salle` (
  `id` int(11) NOT NULL,
  `numsa` int(11) NOT NULL,
  `etagesa` int(11) NOT NULL,
  `typesa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salle`
--

INSERT INTO `salle` (`id`, `numsa`, `etagesa`, `typesa`) VALUES
(1, 1, 1, 'Administratif'),
(2, 2, 1, 'Administratif'),
(3, 1, 3, 'Opération'),
(4, 1, 4, 'Consultation'),
(5, 1, 2, 'Opération'),
(6, 2, 2, 'Opération'),
(7, 2, 3, 'Consultation'),
(8, 2, 4, 'Consultation'),
(9, 3, 2, 'Repos'),
(10, 1, 3, 'Administratif'),
(11, 2, 3, 'Chambre'),
(12, 3, 3, 'Chambre'),
(13, 4, 3, 'Chambre'),
(14, 5, 3, 'Chambre');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `nomst` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `dateexpirationst` date NOT NULL,
  `quantites` int(11) NOT NULL,
  `Stockcategories` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `nomst`, `description`, `dateexpirationst`, `quantites`, `Stockcategories`) VALUES
(1, 'Aspirine', 'utilisé pour réduire la douleur, la fièvre et / ou l’inflammation, et comme antithrombotique. Les conditions inflammatoires spécifiques que l’aspirine est utilisée pour traiter comprennent la maladie de Kawasaki, la péricardite et la fièvre rhumatismale.', '2023-03-04', 5, 3),
(2, 'Omeprazole', 'utilisé en association avec des antibiotiques (par exemple, amoxicilline, clarithromycine) pour traiter les ulcères associés à l’infection causée par la bactérie H. pylori.', '2027-10-13', 251, 4),
(3, 'Simvastatine', 'est utilisée pour abaisser les taux sanguins de « mauvais » cholestérol (lipoprotéines de basse densité, ou LDL), pour augmenter les niveaux de « bon » cholestérol (lipoprotéines de haute densité, ou HDL) et pour abaisser les triglycérides (un type de gr', '2025-06-21', 320, 5),
(4, 'Metformine', 'utilisé avec un régime alimentaire pour abaisser les taux élevés de sucre dans le sang chez les patients atteints de diabète de type 2. La metformine agit en réduisant la quantité de glucose absorbée par les intestins, en diminuant la quantité de glucose', '2027-06-09', 110, 6),
(5, 'Insuline', 'une hormone peptidique contenant deux chaînes réticulées par des ponts disulfures. L’insuline (/ ˈɪn.sjʊ.lɪn /, du latin insula, « île ») est une hormone peptidique produite par les cellules bêta des îlots pancréatiques codées chez l’homme par le gène INS', '2025-10-22', 50, 7),
(6, 'Lévothyroxine', 'est utilisé pour traiter le déficit en hormones thyroïdiennes (hypothyroïdie), y compris une forme sévère connue sous le nom de coma myxœdème. Il peut également être utilisé pour traiter et prévenir certains types de tumeurs thyroïdiennes.', '2024-10-16', 45, 8),
(7, 'Diazépam', 'est utilisé pour traiter le déficit en hormones thyroïdiennes (hypothyroïdie), y compris une forme sévère connue sous le nom de coma myxœdème. Il peut également être utilisé pour traiter et prévenir certains types de tumeurs thyroïdiennes.', '2026-10-21', 781, 9),
(8, 'Céfalexine', 'est un inhibiteur de la pompe à protons qui diminue la quantité d’acide produite dans l’estomac. L’oméprazole est utilisé pour traiter les symptômes du reflux gastro-œsophagien pathologique (RGO) et d’autres affections causées par un excès d’acide gastriq', '2026-10-21', 42, 10),
(9, 'panadol', 'est utilisé pour réduire la fièvre et soulager la douleur, y compris les maux de dents, les maux de tête, la migraine, les douleurs musculaires, la douleur', '2026-06-21', 126, 2),
(10, 'doliprane', 'médicament de douleur', '2023-03-06', 556, 3);

-- --------------------------------------------------------

--
-- Table structure for table `stockcategories`
--

CREATE TABLE `stockcategories` (
  `id` int(11) NOT NULL,
  `typecat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stockcategories`
--

INSERT INTO `stockcategories` (`id`, `typecat`) VALUES
(1, 'Antiagrégant plaquettaire'),
(2, 'Anti-ulcéreux'),
(3, 'Hypolipémiant\r\n'),
(4, 'Hypoglycémiant oral'),
(5, 'Hypoglycémiant injectable'),
(6, 'Hormone thyroïdienne'),
(7, ' Hypnotique'),
(8, 'Céphalosporine'),
(9, 'Antipyrétique'),
(10, 'analgésique');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `email` varchar(180) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `is_verified` tinyint(1) DEFAULT 0,
  `username` varchar(255) DEFAULT NULL,
  `phone_number` int(11) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role_id`, `email`, `password`, `nom`, `prenom`, `is_verified`, `username`, `phone_number`, `gender`) VALUES
(1, 1, 'aziz.hannachi@gmail.com', '$2a$10$onjSGbnFL5sjYt4kuKPTd.ImIP/gDVrAmX2nER8KK.fCZGsH/OHwW', 'hannachi', 'aziz', 1, 'minouche', 25625123, 'Homme'),
(2, 1, 'mahmoud.jebali@gmail.com', '$2a$10$MjU3pgOnVRAvYy4NJ6ZpL.ZY/BNmkoavHXNlcFh/OUzxuPgndGGvC', 'jebali', 'mahmoud', 1, 'manouche', 26153425, 'Femme'),
(3, 2, 'sana.saadallah@gmail.com', '$2a$10$86HRrjh0IMee8XLYzx2A5O5xsNdQutd.ik/5dAOefRiQ86tf2ydwq', 'saadallah', 'sana', 1, 'minouche master', 26158952, 'Chient'),
(4, 2, 'haythem.louati@gmail.com', '$2a$10$pIqVdB3VUldJF5z2DRgQ.OiMLFeXtU9s4jDyvxMViA7ThosOKJBaC', 'louati', 'haythem', 1, 'minouche lord', 95665821, 'Chat'),
(5, 3, 'ines.bezine@gmail.com', '$2a$10$UYnjbgF2nXMy9TX12vd7/.Iyk176R3Jdy5z7KbhajGoRgACMc58Eu', 'bezine', 'ines', 1, 'El Minouchetta', 95215552, 'Furret'),
(6, 3, 'Taher.rejeb@gmail.com', '$2a$10$PZ1JGSLfy2y5trxcwIS4OOClelPD/5WIU0bnhJrWev3lYf7XMu6By', 'rejeb', 'taher', 0, 'El minoucho', 96650015, 'Hélicoptère'),
(7, 3, 'dorra.bejaoui@gmail.com', '$2a$10$b32JWQ7X4IkDEKXrR/MIOuuFzlF3exYMUNhuEng6pb3WVPhPVqd1e', 'bejaoui', 'dorra', 0, 'La Manouche', 15001251, 'Poubelle à glace');

-- --------------------------------------------------------

--
-- Table structure for table `vehicules`
--

CREATE TABLE `vehicules` (
  `id` int(11) NOT NULL,
  `nomvh` varchar(255) NOT NULL,
  `dispovh` tinyint(1) NOT NULL,
  `etatvh` varchar(255) NOT NULL,
  `descvh` varchar(255) NOT NULL,
  `imagesvh` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `Categoriesvehicules` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicules`
--

INSERT INTO vehicules (id, nomvh, dispovh, etatvh, descvh, imagesvh, date, Categoriesvehicules) VALUES
(1, 'Ambulance', 0, 'fonctionnelle', 'Véhicule de catégorie C : Ambulance', '64068c1f7c0d3.jpg', '2023-03-01 13:44:00', 2),
(2, 'Ambulance de secours', 0, 'non fonctionnelle', 'Véhicule de catégorie A : Ambulance de secours et de soins d\'urgence (ASSU)', '64068c4876c96.jpg', '2023-03-02 13:50:00', 1),
(3, 'Voiture de secours aux asphyxiés et blessés', 0, 'fonctionnelle', 'Véhicule de catégorie B : Voiture de secours aux asphyxiés et blessés (VSAB)', '64068c8968fd4.jpg', '2023-02-27 18:04:00', 2),
(4, 'Voiture de secours aux asphyxiés et blessés', 0, 'fonctionnelle', 'Véhicule de catégorie B : Voiture de secours aux asphyxiés et blessés (VSAB)', '64068ca3442fa.jpg', '2023-03-01 16:08:00', 2),
(5, 'Ambulance', 0, 'fonctionnelle', 'Véhicule de catégorie C : Ambulance', '64068cb81baf2.jpg', '2023-02-06 00:37:00', 2),
(6, 'Ambulance de secours', 0, 'fonctionnelle', 'Véhicule de catégorie A : Ambulance de secours et de soins d\'urgence (ASSU)', '64068cd5ab0cf.jpg', '2023-03-02 12:20:00', 2),
(7, 'Ambulance de secours', 0, 'fonctionnelle', 'Véhicule de catégorie A : Ambulance de secours et de soins d\'urgence (ASSU)', '64068cec71874.jpg', '2023-03-01 12:57:00', 2),
(8, 'Ambulance de secours', 0, 'fonctionnelle', 'Véhicule de catégorie A : Ambulance de secours et de soins d\'urgence (ASSU)', '64068d147c57b.jpg', '2023-03-03 12:58:00', 2),
(9, 'Voiture de secours aux asphyxiés et blessés ', 0, 'fonctionnelle', 'Véhicule de catégorie B : Voiture de secours aux asphyxiés et blessés (VSAB)', '64068d44c660d.jpg', '2023-03-06 00:32:00', 2),
(10, 'Ambulance', 0, 'non fonctionnelle', 'Véhicule de catégorie C : Ambulance', '64068d59bd02f.jpg', '2023-03-07 00:36:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoriesequipement`
--
ALTER TABLE `categoriesequipement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categoriesvehicules`
--
ALTER TABLE `categoriesvehicules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disabled_until`
--
ALTER TABLE `disabled_until`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `equipement`
--
ALTER TABLE `equipement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B8B4C6F3B0074144` (`Categoriesequipement`);

--
-- Indexes for table `historique`
--
ALTER TABLE `historique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_EDBFD5ECA76ED395` (`user_id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `plannification`
--
ALTER TABLE `plannification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E88A48124E977E5C` (`salle`);

--
-- Indexes for table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C09A9BA88F565158` (`Salle`),
  ADD KEY `IDX_C09A9BA82CECF817` (`Type`);

--
-- Indexes for table `rendezvous_type`
--
ALTER TABLE `rendezvous_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rendezvous_user`
--
ALTER TABLE `rendezvous_user`
  ADD PRIMARY KEY (`rendezvous_id`,`user_id`),
  ADD KEY `IDX_C1DEFEC83345E0A3` (`rendezvous_id`),
  ADD KEY `IDX_C1DEFEC8A76ED395` (`user_id`);

--
-- Indexes for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7CE748AA76ED395` (`user_id`);

--
-- Indexes for table `roleuser`
--
ALTER TABLE `roleuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4B36566067373F03` (`Stockcategories`);

--
-- Indexes for table `stockcategories`
--
ALTER TABLE `stockcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD KEY `IDX_8D93D649D60322AC` (`role_id`);

--
-- Indexes for table `vehicules`
--
ALTER TABLE `vehicules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_78218C2DA69B1660` (`Categoriesvehicules`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoriesequipement`
--
ALTER TABLE `categoriesequipement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `categoriesvehicules`
--
ALTER TABLE `categoriesvehicules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `disabled_until`
--
ALTER TABLE `disabled_until`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipement`
--
ALTER TABLE `equipement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `historique`
--
ALTER TABLE `historique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plannification`
--
ALTER TABLE `plannification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rendezvous`
--
ALTER TABLE `rendezvous`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rendezvous_type`
--
ALTER TABLE `rendezvous_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roleuser`
--
ALTER TABLE `roleuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salle`
--
ALTER TABLE `salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stockcategories`
--
ALTER TABLE `stockcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vehicules`
--
ALTER TABLE `vehicules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipement`
--
ALTER TABLE `equipement`
  ADD CONSTRAINT `FK_B8B4C6F3B0074144` FOREIGN KEY (`Categoriesequipement`) REFERENCES `categoriesequipement` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `historique`
--
ALTER TABLE `historique`
  ADD CONSTRAINT `FK_EDBFD5ECA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `plannification`
--
ALTER TABLE `plannification`
  ADD CONSTRAINT `FK_E88A48124E977E5C` FOREIGN KEY (`salle`) REFERENCES `salle` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD CONSTRAINT `FK_C09A9BA82CECF817` FOREIGN KEY (`Type`) REFERENCES `rendezvous_type` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_C09A9BA88F565158` FOREIGN KEY (`Salle`) REFERENCES `salle` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rendezvous_user`
--
ALTER TABLE `rendezvous_user`
  ADD CONSTRAINT `FK_C1DEFEC83345E0A3` FOREIGN KEY (`rendezvous_id`) REFERENCES `rendezvous` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C1DEFEC8A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reset_password_request`
--
ALTER TABLE `reset_password_request`
  ADD CONSTRAINT `FK_7CE748AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `FK_4B36566067373F03` FOREIGN KEY (`Stockcategories`) REFERENCES `stockcategories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D649D60322AC` FOREIGN KEY (`role_id`) REFERENCES `roleuser` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicules`
--
ALTER TABLE `vehicules`
  ADD CONSTRAINT `FK_78218C2DA69B1660` FOREIGN KEY (`Categoriesvehicules`) REFERENCES `categoriesvehicules` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;