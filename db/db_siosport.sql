-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 09 mai 2023 à 09:44
-- Version du serveur : 5.7.42
-- Version de PHP : 8.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_siosport`
--
CREATE DATABASE IF NOT EXISTS `db_siosport` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_siosport`;

-- --------------------------------------------------------

--
-- Structure de la table `t_historique`
--

CREATE TABLE `t_historique` (
  `his_session` int(11) NOT NULL,
  `his_utilisateur` int(11) NOT NULL,
  `his_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_historique`
--

INSERT INTO `t_historique` (`his_session`, `his_utilisateur`, `his_date`) VALUES
(1, 1, '2022-03-14 00:00:00'),
(1, 2, '2022-03-14 00:00:00'),
(2, 1, '2022-03-15 00:00:00'),
(2, 2, '2022-03-24 09:09:58'),
(3, 2, '2022-03-24 07:49:55'),
(4, 2, '2022-03-24 07:49:55'),
(6, 1, '2022-05-02 00:00:00'),
(16, 2, '2022-04-07 08:35:26'),
(20, 2, '2022-04-07 08:36:14');

-- --------------------------------------------------------

--
-- Structure de la table `t_role`
--

CREATE TABLE `t_role` (
  `rol_id` int(11) NOT NULL,
  `rol_libelle` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_role`
--

INSERT INTO `t_role` (`rol_id`, `rol_libelle`) VALUES
(1, 'Animateur'),
(2, 'Participant'),
(3, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `t_session`
--

CREATE TABLE `t_session` (
  `ses_id` int(11) NOT NULL,
  `ses_date` date DEFAULT NULL,
  `ses_heure` time DEFAULT NULL,
  `ses_sport` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_session`
--

INSERT INTO `t_session` (`ses_id`, `ses_date`, `ses_heure`, `ses_sport`) VALUES
(1, '2022-03-14', '14:00:00', 1),
(2, '2022-04-01', '15:00:00', 1),
(3, '2022-03-16', '16:00:00', 3),
(4, '2022-03-17', '17:00:00', 5),
(5, '2022-03-18', '18:00:00', 5),
(6, '2022-03-31', '10:20:00', 2),
(7, '2022-04-01', '20:35:00', 2),
(8, '2022-04-05', '10:25:00', 5),
(9, '2022-04-05', '13:30:00', 3),
(10, '2022-04-05', '16:32:00', 4),
(11, '2022-04-10', '10:30:00', 1),
(12, '2022-04-08', '14:00:00', 2),
(13, '2022-04-09', '10:40:00', 3),
(14, '2022-04-07', '08:50:00', 4),
(15, '2022-04-07', '10:20:00', 4),
(16, '2022-04-07', '08:50:00', 1),
(17, '2022-04-07', '08:50:00', 2),
(18, '2022-04-10', '10:30:00', 1),
(19, '2022-04-08', '14:00:00', 2),
(20, '2022-04-09', '11:00:00', 3),
(21, '2022-04-07', '09:50:00', 4),
(22, '2022-04-07', '10:20:00', 4),
(23, '2022-04-07', '07:50:00', 1),
(24, '2022-04-07', '07:50:00', 2),
(25, '2022-04-07', '07:50:00', 3),
(26, '2022-04-07', '07:50:00', 4),
(27, '2022-04-07', '07:50:00', 5);

-- --------------------------------------------------------

--
-- Structure de la table `t_sport`
--

CREATE TABLE `t_sport` (
  `spo_id` int(11) NOT NULL,
  `spo_libelle` varchar(200) DEFAULT NULL,
  `spo_nbmax` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_sport`
--

INSERT INTO `t_sport` (`spo_id`, `spo_libelle`, `spo_nbmax`) VALUES
(1, 'Tennis', 8),
(2, 'Football', 22),
(3, 'Basketball', 12),
(4, 'Handball', 14),
(5, 'Natation', 5);

-- --------------------------------------------------------

--
-- Structure de la table `t_utilisateur`
--

CREATE TABLE `t_utilisateur` (
  `uti_id` int(11) NOT NULL,
  `uti_nom` varchar(200) DEFAULT NULL,
  `uti_prenom` varchar(200) DEFAULT NULL,
  `uti_mail` varchar(255) DEFAULT NULL,
  `uti_mdp` varchar(255) DEFAULT NULL,
  `uti_role` int(11) DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_utilisateur`
--

INSERT INTO `t_utilisateur` (`uti_id`, `uti_nom`, `uti_prenom`, `uti_mail`, `uti_mdp`, `uti_role`) VALUES
(1, 'Figueroa', 'Theo', 'tf@siosport.com', '$2y$10$9tU0OHRF8bSYj.CAZVu/Mecw/OcXvHiX38IWxndWCfZ.pkCrqiYba', 1),
(2, 'Jaunay', 'Clément', 'cj@siosport.com', '$2y$10$AJozxbxSfi7fk3O.fLTIBuMVapeDmMe8mVXeQD.9W0MgQ.MMGJ3q2', 2),
(3, 'admin', 'admin', 'admin@admin', '$2y$10$YULDdPjKTogSzDoQiwo2Mer1z811OSk4rFZheT/igDi9D1pK3pL0.', 3),
(22, 'test2', 'test2', 'test2@test2', '$2y$10$LsPJoR7Pl6g3TYyeFS9fCO5h./8x50CQM3LLphtEMhgKgrvxXDAFa', 2),
(133, 'aaa', 'aa', 'aa@aa', '$2y$10$3NGpEZLYyOGiguUbvNbh2.dABDFnM9QxgGUKXXGvfHlw0/d3AfKqe', 2),
(134, 'bb', 'bb', 'bb@bb', '$2y$10$kE5s5Vi4B.UK4sqoLJVNleDVF2Fe9pINX306KUNvtksm5WaOZT6JO', 2),
(135, 'cc', 'cc', 'cc@cc', '$2y$10$pxVOKVIy.iAg5onxvR0Gtez/SxLBN06Qu3Apci/VL0Yf0ONHkGEJG', 2),
(138, 'dd', 'dd', 'dd@dd', '$2y$10$3rNaaXMXi7lHZ2fbZx.zFuovRR5w.Tok29Q.eOZ.oF98aOo19qxme', 2),
(139, 'ee', 'ee', 'ee@ee', '$2y$10$v2ZMWn.kgGCI.arwML/77.dFOsOXM9sU5tUuCECfpyegNNMfqAE/W', 2),
(140, 'ff', 'ff', 'ff@ff', '$2y$10$D8JMARHJykq7KYZXWhkXWeXRPiS/OgN0ToJXu3QpDBe.2uFG7jY4a', 2),
(145, 'Mobile', 'Mobile', 'Mobile@mobile', '$2y$10$vCohS4rcCDOECCKdtFZEbeY3ZDQg2QmikipoW.1tWWyNertjEIgXW', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_historique`
--
ALTER TABLE `t_historique`
  ADD PRIMARY KEY (`his_session`,`his_utilisateur`),
  ADD KEY `his_utilisateur` (`his_utilisateur`);

--
-- Index pour la table `t_role`
--
ALTER TABLE `t_role`
  ADD PRIMARY KEY (`rol_id`);

--
-- Index pour la table `t_session`
--
ALTER TABLE `t_session`
  ADD PRIMARY KEY (`ses_id`),
  ADD KEY `ses_sport` (`ses_sport`);

--
-- Index pour la table `t_sport`
--
ALTER TABLE `t_sport`
  ADD PRIMARY KEY (`spo_id`);

--
-- Index pour la table `t_utilisateur`
--
ALTER TABLE `t_utilisateur`
  ADD PRIMARY KEY (`uti_id`),
  ADD UNIQUE KEY `uti_mail` (`uti_mail`),
  ADD KEY `uti_role` (`uti_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_role`
--
ALTER TABLE `t_role`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `t_session`
--
ALTER TABLE `t_session`
  MODIFY `ses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `t_sport`
--
ALTER TABLE `t_sport`
  MODIFY `spo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_utilisateur`
--
ALTER TABLE `t_utilisateur`
  MODIFY `uti_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_historique`
--
ALTER TABLE `t_historique`
  ADD CONSTRAINT `t_historique_ibfk_1` FOREIGN KEY (`his_session`) REFERENCES `t_session` (`ses_id`),
  ADD CONSTRAINT `t_historique_ibfk_2` FOREIGN KEY (`his_utilisateur`) REFERENCES `t_utilisateur` (`uti_id`);

--
-- Contraintes pour la table `t_session`
--
ALTER TABLE `t_session`
  ADD CONSTRAINT `t_session_ibfk_1` FOREIGN KEY (`ses_sport`) REFERENCES `t_sport` (`spo_id`);

--
-- Contraintes pour la table `t_utilisateur`
--
ALTER TABLE `t_utilisateur`
  ADD CONSTRAINT `t_utilisateur_ibfk_1` FOREIGN KEY (`uti_role`) REFERENCES `t_role` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
