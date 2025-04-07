-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 07, 2025 at 11:49 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_appartement`
--

-- --------------------------------------------------------

--
-- Table structure for table `appartements`
--

CREATE TABLE `appartements` (
  `id_appartement` int NOT NULL,
  `villeAppart` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `rue` varchar(255) DEFAULT NULL,
  `arrondissement` varchar(50) DEFAULT NULL,
  `etage` int DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `prix_loc` decimal(15,2) DEFAULT NULL,
  `prix_charg` decimal(15,2) DEFAULT NULL,
  `ascenceur` tinyint(1) DEFAULT NULL,
  `preavis` tinyint(1) DEFAULT NULL,
  `date_libre` date DEFAULT NULL,
  `id_proprietaire` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banque`
--

CREATE TABLE `banque` (
  `id_banque` int NOT NULL,
  `code_banque` varchar(50) DEFAULT NULL,
  `id_locataire` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demandeur`
--

CREATE TABLE `demandeur` (
  `id_dem` int NOT NULL,
  `nom_dem` varchar(50) DEFAULT NULL,
  `prenom_dem` varchar(50) DEFAULT NULL,
  `adresse_dem` varchar(50) DEFAULT NULL,
  `ville_dem` varchar(100) NOT NULL,
  `codeville_dem` int DEFAULT NULL,
  `tel_dem` varchar(50) DEFAULT NULL,
  `code_dem` varchar(10) NOT NULL,
  `decision` tinyint(1) DEFAULT NULL,
  `id_appartement` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id_image` int NOT NULL,
  `chemin_image` varchar(50) DEFAULT NULL,
  `id_appartement` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locataires`
--

CREATE TABLE `locataires` (
  `id_locataire` int NOT NULL,
  `nomLoc` varchar(50) DEFAULT NULL,
  `prenomLoc` varchar(50) DEFAULT NULL,
  `mailLoc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `mdpLoc` varchar(255) DEFAULT NULL,
  `dateNaiss` date DEFAULT NULL,
  `telLoc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id_notification` int NOT NULL,
  `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `date_notif` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_proprietaire` int NOT NULL,
  `id_dem` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- --------------------------------------------------------

--
-- Table structure for table `occuper`
--

CREATE TABLE `occuper` (
  `id_appartement` int NOT NULL,
  `id_locataire` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `proprietaires`
--

CREATE TABLE `proprietaires` (
  `id_proprietaire` int NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `mail` varchar(50) NOT NULL,
  `mdp` varchar(255) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appartements`
--
ALTER TABLE `appartements`
  ADD PRIMARY KEY (`id_appartement`),
  ADD KEY `id_proprietaire` (`id_proprietaire`);

--
-- Indexes for table `banque`
--
ALTER TABLE `banque`
  ADD PRIMARY KEY (`id_banque`),
  ADD KEY `id_locataire` (`id_locataire`);

--
-- Indexes for table `demandeur`
--
ALTER TABLE `demandeur`
  ADD PRIMARY KEY (`id_dem`),
  ADD KEY `index_id_appartement` (`id_appartement`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `id_appartement` (`id_appartement`);

--
-- Indexes for table `locataires`
--
ALTER TABLE `locataires`
  ADD PRIMARY KEY (`id_locataire`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id_notification`),
  ADD KEY `id_proprietaire` (`id_proprietaire`),
  ADD KEY `id_dem` (`id_dem`);

--
-- Indexes for table `occuper`
--
ALTER TABLE `occuper`
  ADD PRIMARY KEY (`id_appartement`,`id_locataire`),
  ADD KEY `id_locataire` (`id_locataire`);

--
-- Indexes for table `proprietaires`
--
ALTER TABLE `proprietaires`
  ADD PRIMARY KEY (`id_proprietaire`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appartements`
--
ALTER TABLE `appartements`
  MODIFY `id_appartement` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `banque`
--
ALTER TABLE `banque`
  MODIFY `id_banque` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `demandeur`
--
ALTER TABLE `demandeur`
  MODIFY `id_dem` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id_image` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `locataires`
--
ALTER TABLE `locataires`
  MODIFY `id_locataire` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id_notification` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `proprietaires`
--
ALTER TABLE `proprietaires`
  MODIFY `id_proprietaire` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appartements`
--
ALTER TABLE `appartements`
  ADD CONSTRAINT `appartements_ibfk_1` FOREIGN KEY (`id_proprietaire`) REFERENCES `proprietaires` (`id_proprietaire`);

--
-- Constraints for table `banque`
--
ALTER TABLE `banque`
  ADD CONSTRAINT `banque_ibfk_1` FOREIGN KEY (`id_locataire`) REFERENCES `locataires` (`id_locataire`);

--
-- Constraints for table `demandeur`
--
ALTER TABLE `demandeur`
  ADD CONSTRAINT `fk_id_appartement` FOREIGN KEY (`id_appartement`) REFERENCES `appartements` (`id_appartement`);

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id_appartement`) REFERENCES `appartements` (`id_appartement`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`id_proprietaire`) REFERENCES `proprietaires` (`id_proprietaire`),
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`id_dem`) REFERENCES `demandeur` (`id_dem`);

--
-- Constraints for table `occuper`
--
ALTER TABLE `occuper`
  ADD CONSTRAINT `occuper_ibfk_1` FOREIGN KEY (`id_appartement`) REFERENCES `appartements` (`id_appartement`),
  ADD CONSTRAINT `occuper_ibfk_2` FOREIGN KEY (`id_locataire`) REFERENCES `locataires` (`id_locataire`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
