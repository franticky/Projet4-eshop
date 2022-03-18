-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 18 mars 2022 à 08:46
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `surfbotte`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `nom_article` varchar(255) NOT NULL,
  `description_article` text NOT NULL,
  `prix_article` float NOT NULL,
  `stock_article` tinyint(1) DEFAULT NULL,
  `date_article` datetime DEFAULT NULL,
  `image_article` varchar(255) NOT NULL,
  PRIMARY KEY (`id_article`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id_article`, `nom_article`, `description_article`, `prix_article`, `stock_article`, `date_article`, `image_article`) VALUES
(12, 'Leg Rope', 'Surfboard Leash Straight Surf Board \r\nAIHOME Leg Rope', 25, 0, '2022-03-11 00:00:00', '../Projet4b/img/LegRope.jpg'),
(13, 'Surfboard Single Fin', 'Une nageoire de planche de surf ou skeg est un hydroptille montÃ© Ã  la queue dâ€™une planche de surf ou dâ€™une planche similaire pour amÃ©liorer la stabilitÃ© directionnelle et le contrÃ´le par la direction du pied.', 104, 1, '2022-03-25 00:00:00', '../Projet4b/img/SurfboardSingleFin.jpg'),
(14, 'Hydroponic Surf Skate', 'The Hydroponic Surf Skates™ are Old School Skate decks featuring a 80\'s shape and inspired by surfing. These set ups let you ride your skateboard as if you were truly surfing your board in the sea. ', 119, 0, '2022-03-12 00:00:00', '../Projet4b/img/HydroponicSurfSkate.jpg'),
(15, 'Kitesurfing voile', 'Kitesurfingvoile', 54, 0, '2022-03-16 00:00:00', '../Projet4b/img/Kitesurfingvoile.jpg'),
(16, 'MarshallFullsuit ', 'MarshallFullsuit ', 546, 0, '2022-03-08 00:00:00', '../Projet4b/img/MarshallFullsuit .webp'),
(2, 'Longboard', 'Longboard', 450, 0, '2022-03-11 00:00:00', '../Projet4b/img/Longboard.jpg'),
(10, 'Poster fantastic four', 'Poster fantastic four', 45, 0, '2022-03-05 00:00:00', '../Projet4b/img/poster F4.jpg'),
(11, 'Wedge Handboard', 'The Wedge handboard can actually place torque and pressure on your shoulder if you catch the wave incorrectly. It would essentially act as a floatation device that can drag you with the wave. Since you are traveling at higher speeds with increased buoyancy, wipeouts are intensified.', 251, 0, '2022-03-25 00:00:00', '../Projet4b/img/WedgeHandboard .jpg');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(255) NOT NULL AUTO_INCREMENT,
  `mel_user` varchar(255) NOT NULL,
  `passe_user` varchar(255) NOT NULL,
  `edit` varchar(255) NOT NULL,
  `supprimer_user` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `mel_user`, `passe_user`, `edit`, `supprimer_user`) VALUES
(3, 'thebranson@aol.com', 'itStheStach3', '', ''),
(2, 'johnwayne@outlook95.com', 'r1ghtup', '', ''),
(4, 'clinteastwood@3615.com', 'doyoukn0mybrother', '', ''),
(8, 'nicknolte@3615.com', 'gimme4reason', '', ''),
(9, 'heatherlocklear@myspace.com', 'melrosepl4ce', '', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
