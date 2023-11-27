-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : database
-- Généré le : dim. 26 nov. 2023 à 20:35
-- Version du serveur : 8.0.35
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `compta`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20231126174932', '2023-11-26 20:04:14', 736);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `facture_id` int NOT NULL,
  `date_facture` date DEFAULT NULL,
  `numero_facture` varchar(45) DEFAULT NULL,
  `designation` varchar(45) DEFAULT NULL,
  `code_produit` varchar(45) DEFAULT NULL,
  `quantité` varchar(45) DEFAULT NULL,
  `prix_unitaire` varchar(45) DEFAULT NULL,
  `montant HT` varchar(45) DEFAULT NULL,
  `remise` varchar(45) DEFAULT NULL,
  `TVA` varchar(45) DEFAULT NULL,
  `montant TTC` varchar(45) DEFAULT NULL,
  `fournisseur_fournisseur_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `fournisseur_id` int NOT NULL,
  `nom` varchar(45) DEFAULT NULL,
  `prenom` varchar(45) DEFAULT NULL,
  `adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `siren` varchar(45) DEFAULT NULL,
  `nom_entreprise` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`fournisseur_id`, `nom`, `prenom`, `adresse`, `siren`, `nom_entreprise`) VALUES
(3, 'Gusikowski', 'Libby', '729 Rohan Forest Apt. 135\nChetstad, MS 37268-4291', '82646570', 'Mayer-Bergnaum'),
(4, 'Hettinger', 'Octavia', '669 Candido Stravenue Apt. 456\nNew Colleen, OK 64176-5049', '25998531', 'Greenfelder, West and Koelpin'),
(5, 'Kertzmann', 'Eliane', '0996 Samantha Radial\nClydemouth, FL 54622', '70525052', 'Littel-Boyer'),
(6, 'Huels', 'Rose', '140 Kristina Fall\nBalistrerichester, IN 69788', '67266399', 'Cremin Group'),
(7, 'Dibbert', 'Dexter', '29577 Corwin Falls Apt. 498\nBernhardburgh, CA 70449', '83354375', 'Witting, Gerhold and Barton');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur_has_secteur`
--

CREATE TABLE `fournisseur_has_secteur` (
  `fournisseur_fournisseur_id` int NOT NULL,
  `secteur_secteur_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `secteur`
--

CREATE TABLE `secteur` (
  `secteur_id` int NOT NULL,
  `nom_secteur` varchar(45) DEFAULT NULL,
  `code_secteur` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `station_essence`
--

CREATE TABLE `station_essence` (
  `station_essence_id` int NOT NULL,
  `nom_station` varchar(45) DEFAULT NULL,
  `adresse` varchar(45) DEFAULT NULL,
  `siren` varchar(45) DEFAULT NULL,
  `secteur_secteur_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`user_id`, `nom`, `prenom`, `password`, `email`, `adresse`, `mobile`) VALUES
(11, 'Lang', 'Dorris', '?#.vCpqBIW', 'elmo.larkin@emmerich.com', '286 Minnie Prairie Apt. 491\nNew Jamilfort, GA 84719-6771', '1-880-083-9973'),
(12, 'Witting', 'Letha', 'mW19X^$?\'HC/', 'stoltenberg.armani@carter.com', '5904 Block Meadow Suite 168\nLake Terrence, TN 81163-5121', '(740)796-3335'),
(13, 'Romaguera', 'Domenick', 'JWuCAtt', 'stehr.aliya@erdman.net', '4164 Raphaelle Club\nOlsonshire, MD 17847-7649', '517-720-9489x9822'),
(14, 'Dickinson', 'Kraig', 'm#fAs)qdy%.', 'zrunte@yahoo.com', '9574 Toy Spur\nLake Leannaville, AZ 99674-5709', '(458)779-5369x0002'),
(15, 'Mertz', 'Lorena', '~T?G%T<3qOhxg@g', 'niko.tromp@yahoo.com', '672 Jayde Circle Suite 393\nMarlinport, KY 38868', '539-254-3539'),
(16, 'Roob', 'Cheyanne', '%0TY`@ubF~75ur`z', 'feest.annalise@gmail.com', '108 Marvin Brooks Apt. 643\nMosciskiville, MD 46068-5030', '211-913-4611x68270'),
(17, 'Beer', 'Leola', 'B\",l;~9d)CmRCE39@&3', 'zack62@hotmail.com', '94175 Kaia Meadows Suite 579\nEast Thad, IA 30482-5957', '914-753-0389'),
(18, 'Reinger', 'Ralph', 'x:}#Ur-j*=UJSC', 'damore.reyes@smitham.com', '74398 Ludwig Light\nNew Danniechester, IL 61902-2925', '817.533.0148'),
(19, 'Watsica', 'Micaela', '2~Fd+qr', 'roosevelt61@farrell.com', '43647 Jasper Burg\nEast Lanceshire, IA 32190-6493', '745-668-4654'),
(20, 'Moen', 'Hallie', 'qIz`+<&X1S&3x(@}$', 'theresia96@stark.net', '7506 Lilian Valley\nNew Braulio, IN 93436-7927', '+68(0)3803491622');

-- --------------------------------------------------------

--
-- Structure de la table `user_has_facture`
--

CREATE TABLE `user_has_facture` (
  `user_user_id` int NOT NULL,
  `facture_facture_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_880E0D76E7927C74` (`email`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`facture_id`,`fournisseur_fournisseur_id`),
  ADD KEY `fk_facture_fournisseur1_idx` (`fournisseur_fournisseur_id`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`fournisseur_id`);

--
-- Index pour la table `fournisseur_has_secteur`
--
ALTER TABLE `fournisseur_has_secteur`
  ADD PRIMARY KEY (`fournisseur_fournisseur_id`,`secteur_secteur_id`),
  ADD KEY `fk_fournisseur_has_secteur_secteur1_idx` (`secteur_secteur_id`),
  ADD KEY `fk_fournisseur_has_secteur_fournisseur1_idx` (`fournisseur_fournisseur_id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `secteur`
--
ALTER TABLE `secteur`
  ADD PRIMARY KEY (`secteur_id`);

--
-- Index pour la table `station_essence`
--
ALTER TABLE `station_essence`
  ADD PRIMARY KEY (`station_essence_id`,`secteur_secteur_id`),
  ADD KEY `fk_station_essence_secteur1_idx` (`secteur_secteur_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Index pour la table `user_has_facture`
--
ALTER TABLE `user_has_facture`
  ADD PRIMARY KEY (`user_user_id`,`facture_facture_id`),
  ADD KEY `fk_user_has_facture_facture1_idx` (`facture_facture_id`),
  ADD KEY `fk_user_has_facture_user_idx` (`user_user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `facture_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `fournisseur_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `fk_facture_fournisseur1` FOREIGN KEY (`fournisseur_fournisseur_id`) REFERENCES `fournisseur` (`fournisseur_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `fournisseur_has_secteur`
--
ALTER TABLE `fournisseur_has_secteur`
  ADD CONSTRAINT `fk_fournisseur_has_secteur_fournisseur1` FOREIGN KEY (`fournisseur_fournisseur_id`) REFERENCES `fournisseur` (`fournisseur_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_fournisseur_has_secteur_secteur1` FOREIGN KEY (`secteur_secteur_id`) REFERENCES `secteur` (`secteur_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `station_essence`
--
ALTER TABLE `station_essence`
  ADD CONSTRAINT `fk_station_essence_secteur1` FOREIGN KEY (`secteur_secteur_id`) REFERENCES `secteur` (`secteur_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user_has_facture`
--
ALTER TABLE `user_has_facture`
  ADD CONSTRAINT `fk_user_has_facture_facture1` FOREIGN KEY (`facture_facture_id`) REFERENCES `facture` (`facture_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_has_facture_user` FOREIGN KEY (`user_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
