-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Mar 14 Novembre 2017 à 10:16
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `siteBanque`
--

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `comptes` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `type_account` varchar(20) NOT NULL,
  `owner` varchar(100) NOT NULL,
  `credit` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `compte`
--

INSERT INTO `comptes` (`id`, `idUser`, `type_account`, `owner`, `credit`) VALUES
(58, 13, 'compteEtudiant', 'baptiste', 480.89),
(59, 12, 'livretA', 'tabouret', 480.93),
(62, 12, 'compteEtudiant', 'tabouret', 491),
(63, 13, 'livretA', 'baptiste', 66.21),
(65, 14, 'livret+', 'machin', 0.93),
(66, 14, 'compteEtudiant', 'machin', 68.93),
(67, 14, 'livretA', 'machin', 324.93),
(68, 12, 'livret+', 'tabouret', 0.93);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateurs` (`id`, `pseudo`, `password`, `mail`) VALUES
(12, 'tabouret', '$2y$10$liyd3/kbiwEx/Dgn3rx49u8v5ErYZhjS1qrVjtR0jIdLJtxFUzPWm', 'tabouret@gmail.com'),
(13, 'baptiste', '$2y$10$etNtfP7sWMMAfSiW1buLrOWjdoDH65vZdVC3b.SqYT7uL5zOsM6zW', 'baptiste@simplon.fr'),
(14, 'machin', '$2y$10$orGbgwZ.KIiRAG.4GJJZ1u0ltPtzpzX1jJytrCRThvsw0M4x.W68W', 'machin@bidule.com');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `compte`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_3` (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`),
  ADD KEY `type_account` (`type_account`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `id_4` (`id`),
  ADD KEY `id_5` (`id`),
  ADD KEY `id_6` (`id`),
  ADD KEY `id_7` (`id`),
  ADD KEY `id_8` (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `comptes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `compte`
--
ALTER TABLE `comptes`
  ADD CONSTRAINT `comptes_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `utilisateurs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
