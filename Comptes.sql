-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : blaguesdfkroot.mysql.db
-- Généré le :  mar. 29 mai 2018 à 16:07
-- Version du serveur :  5.6.39-log
-- Version de PHP :  5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blaguesdfkroot`
--

-- --------------------------------------------------------

--
-- Structure de la table `Comptes`
--

CREATE TABLE `Comptes` (
  `adressemail` varchar(50) DEFAULT NULL,
  `motdepasse` varchar(20) DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `civilite` varchar(50) NOT NULL,
  `nomsociete` varchar(50) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `id` int(11) NOT NULL,
  `token` varchar(50) DEFAULT NULL,
  `passQR` varchar(50) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `participant` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='allez';

--
-- Déchargement des données de la table `Comptes`
--

INSERT INTO `Comptes` (`adressemail`, `motdepasse`, `nom`, `prenom`, `adresse`, `civilite`, `nomsociete`, `cp`, `ville`, `id`, `token`, `passQR`, `admin`, `participant`) VALUES
('guig@gmail.com', '123456789', '', '', '', '', '', '', '', 21, NULL, NULL, 0, 0),
('cryptoto@gmail.com', 'paulalove', '', '', '', '', '', '', '', 23, 'd51030226c3bd22e474ade3b', NULL, 1, 0),
('mathilde@math.com', 'mathilde', '', '', '', '', '', '', '', 24, NULL, NULL, 0, 0),
('salut@la.fr', 'onpeutpasdire', '', '', '', '', '', '', '', 25, NULL, NULL, 0, 0),
('ici@ici.fr', '0123456789', '', '', '', '', '', '', '', 26, NULL, NULL, 0, 1),
('giomebs@gmail.com', 'test', 'test', 'guillaume', '', '', '', '', '', 27, NULL, NULL, 0, 0),
('acro-@hotmail.fr', 'adminadmin', 'admin', 'admin', '', '', '', '', '', 28, NULL, NULL, 1, 0),
('onessaie@gmail.com', 'tototo', '', '', '', '', '', '', '', 29, NULL, NULL, 0, 0),
('michau@gmail.com', 'mathilde', '', '', '', '', '', '', '', 30, NULL, NULL, 0, 0),
('michau.mathilde@gmail.com', 'MATHILDE', '', '', '', '', '', '', '', 31, NULL, '362a727add32183f4e6763c8', 0, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Comptes`
--
ALTER TABLE `Comptes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `adressemail` (`adressemail`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Comptes`
--
ALTER TABLE `Comptes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
