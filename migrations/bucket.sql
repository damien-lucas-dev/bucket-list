-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 28 avr. 2021 à 10:52
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bucket`
--

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Travel & Adventure'),
(2, 'Sport'),
(3, 'Entertainment'),
(4, 'Human Relations'),
(5, 'Others');

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `username`) VALUES
(1, 'yo@yo.com', '[]', '$argon2id$v=19$m=65536,t=4,p=1$WFhXVzN2Wkx4aHV5T1BTSA$DRB549z0WneeEDsENjwFQ9FGCNIMq6XBMvD5NgqZNtc', 'yoyoyo');

--
-- Déchargement des données de la table `wish`
--

INSERT INTO `wish` (`id`, `title`, `description`, `author`, `is_published`, `date_created`, `category_id`) VALUES
(3, 'Go to India', 'I\'d to see the Golden Graeat Temple near the water!', 'Dams', 1, '2021-04-27 21:52:47', 1),
(4, 'Talk to mum', 'I\'d like to say her some things', 'Alex', 1, '2021-04-27 21:53:08', 4),
(5, 'Mon idée', 'ma description', 'mon nom', 1, '2021-04-27 22:32:07', 1),
(6, 'Mon idée', 'Ma description de **** à **** ****', 'yoyoyo', 1, '2021-04-28 10:31:52', 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
