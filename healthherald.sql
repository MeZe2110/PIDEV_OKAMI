-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 11 fév. 2023 à 12:47
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
-- Base de données : `healthherald`
--

-- --------------------------------------------------------

--
-- Structure de la table `categoriesequipement`
--

CREATE TABLE `categoriesequipement` (
  `id` int(11) NOT NULL,
  `nomcate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categoriesvehicules`
--

CREATE TABLE `categoriesvehicules` (
  `id` int(11) NOT NULL,
  `typecatv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230211103931', '2023-02-11 11:39:46', 113),
('DoctrineMigrations\\Version20230211104722', '2023-02-11 11:47:26', 103),
('DoctrineMigrations\\Version20230211105650', '2023-02-11 11:57:07', 70),
('DoctrineMigrations\\Version20230211110350', '2023-02-11 12:03:55', 127),
('DoctrineMigrations\\Version20230211111347', '2023-02-11 12:14:03', 106),
('DoctrineMigrations\\Version20230211112038', '2023-02-11 12:20:44', 54),
('DoctrineMigrations\\Version20230211112628', '2023-02-11 12:26:33', 106),
('DoctrineMigrations\\Version20230211113141', '2023-02-11 12:31:49', 107);

-- --------------------------------------------------------

--
-- Structure de la table `equipement`
--

CREATE TABLE `equipement` (
  `id` int(11) NOT NULL,
  `cate_id` int(11) DEFAULT NULL,
  `nomeq` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etateq` tinyint(1) NOT NULL,
  `dispoeq` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `plannification`
--

CREATE TABLE `plannification` (
  `id` int(11) NOT NULL,
  `salle_id` int(11) DEFAULT NULL,
  `datepl` date NOT NULL,
  `heuredebutpl` time NOT NULL,
  `heurefinpl` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rendezvous`
--

CREATE TABLE `rendezvous` (
  `id` int(11) NOT NULL,
  `daterv` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roleutilisateur`
--

CREATE TABLE `roleutilisateur` (
  `id` int(11) NOT NULL,
  `roleut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE `salle` (
  `id` int(11) NOT NULL,
  `numsa` int(11) NOT NULL,
  `etagesa` int(11) NOT NULL,
  `typesa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `nomst` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etatst` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateexpirationst` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stockcat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `stockcategories`
--

CREATE TABLE `stockcategories` (
  `id` int(11) NOT NULL,
  `typecat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nomut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenomut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emailut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdput` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roleut_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `vehicules`
--

CREATE TABLE `vehicules` (
  `id` int(11) NOT NULL,
  `catv_id` int(11) NOT NULL,
  `nomvh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dispovh` tinyint(1) NOT NULL,
  `etatvh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descvh` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categoriesequipement`
--
ALTER TABLE `categoriesequipement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categoriesvehicules`
--
ALTER TABLE `categoriesvehicules`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B8B4C6F37D3008E5` (`cate_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `plannification`
--
ALTER TABLE `plannification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E88A4812DC304035` (`salle_id`);

--
-- Index pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roleutilisateur`
--
ALTER TABLE `roleutilisateur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4B365660F085592E` (`stockcat_id`);

--
-- Index pour la table `stockcategories`
--
ALTER TABLE `stockcategories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_1D1C63B369D7B1C4` (`roleut_id`);

--
-- Index pour la table `vehicules`
--
ALTER TABLE `vehicules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_78218C2D3F9CF094` (`catv_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categoriesequipement`
--
ALTER TABLE `categoriesequipement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categoriesvehicules`
--
ALTER TABLE `categoriesvehicules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `equipement`
--
ALTER TABLE `equipement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `plannification`
--
ALTER TABLE `plannification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rendezvous`
--
ALTER TABLE `rendezvous`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roleutilisateur`
--
ALTER TABLE `roleutilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `salle`
--
ALTER TABLE `salle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stockcategories`
--
ALTER TABLE `stockcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `vehicules`
--
ALTER TABLE `vehicules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `equipement`
--
ALTER TABLE `equipement`
  ADD CONSTRAINT `FK_B8B4C6F37D3008E5` FOREIGN KEY (`cate_id`) REFERENCES `categoriesequipement` (`id`);

--
-- Contraintes pour la table `plannification`
--
ALTER TABLE `plannification`
  ADD CONSTRAINT `FK_E88A4812DC304035` FOREIGN KEY (`salle_id`) REFERENCES `salle` (`id`);

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `FK_4B365660F085592E` FOREIGN KEY (`stockcat_id`) REFERENCES `stockcategories` (`id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_1D1C63B369D7B1C4` FOREIGN KEY (`roleut_id`) REFERENCES `roleutilisateur` (`id`);

--
-- Contraintes pour la table `vehicules`
--
ALTER TABLE `vehicules`
  ADD CONSTRAINT `FK_78218C2D3F9CF094` FOREIGN KEY (`catv_id`) REFERENCES `categoriesvehicules` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
