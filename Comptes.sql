-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 17 Mai 2018 à 10:16
-- Version du serveur :  5.5.59-0+deb8u1
-- Version de PHP :  5.6.33-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `mcm0239a`
--

-- --------------------------------------------------------

--
-- Structure de la table `Comptes`
--

CREATE TABLE IF NOT EXISTS `Comptes` (
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
  `token` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1 COMMENT='allez';

--
-- Contenu de la table `Comptes`
--

INSERT INTO `Comptes` (`adressemail`, `motdepasse`, `nom`, `prenom`, `adresse`, `civilite`, `nomsociete`, `cp`, `ville`, `id`, `token`) VALUES
('guig@gmail.com', '123456789', '', '', '', '', '', '', '', 21, NULL),
('cryptoto@gmail.com', 'paulalove', '', '', '', '', '', '', '', 23, NULL),
('mathilde@math.com', 'mathilde', '', '', '', '', '', '', '', 24, NULL),
('salut@la.fr', 'onpeutpasdire', '', '', '', '', '', '', '', 25, NULL),
('ici@ici.fr', '0123456789', '', '', '', '', '', '', '', 26, NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Comptes`
--
ALTER TABLE `Comptes`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `adressemail` (`adressemail`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Comptes`
--
ALTER TABLE `Comptes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
