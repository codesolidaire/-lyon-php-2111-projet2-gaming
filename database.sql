-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 26 Octobre 2017 à 13:53
-- Version du serveur :  5.7.19-0ubuntu0.16.04.1
-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `simple-mvc`
--

-- --------------------------------------------------------

--
--Create project database
DROP DATABASE IF EXISTS Project2_Gaming;
CREATE DATABASE Project2_Gaming;

--game table script
DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `name` varchar(500) NOT NULL,
                        `createDate` date NOT NULL,
                        `synopsis` text NOT NULL,
                        `editor` varchar(100) NOT NULL,
                        `genre` varchar(100) NOT NULL,
                        `mode` varchar(150) NOT NULL,
                        `img_url_game` varchar(200) NOT NULL,
                        `video_url` varchar(300) NOT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--insert values into Game table
INSERT INTO `game` (`id`, `name`, `createDate`, `synopsis`, `editor`, `genre`, `mode`, `img_url_game`, `video_url`)
    VALUES (1, 'Sword Art Online : Fatal Bullet', '2018-02-23',
    'Bienvenue dans un monde d\'armes à feu : Gun Gale Online, a été graphiquement amélioré et offre de nombreux environnements variés à explorer lors de vos toutes nouvelles aventures.\r\nPlongez en immersion dans un monde aux environnements et textures réalistes.\r\nAmis ou ennemis : invitez vos amis à combattre des boss en coop, ou affrontez-les dans des combats à 4 contre 4. \r\nCombats réalistes et épiques : faites votre choix parmi toute une série d\'armes exceptionnelles et de compétences uniques.', 'Bandai Namco Entertainment', 'RPG', 'Solo, multijoueur', '/assets/images/wildGun.png', 'https://www.youtube.com/embed/DgnlWy1lFvo')

INSERT INTO `game` (`id`, `name`, `createDate`, `synopsis`, `editor`, `genre`, `mode`, `img_url_game`, `video_url`)
    VALUES (2, 'Basic Math - Fun With Numbers', '1997-09-01','The objective is to solve basic arithmetic problems.','Gary Palmer','Basic Math','Solo',
    '/assets/images/Math_game.png', 'https://www.youtube.com/embed/PkUnwKCFTZ8');


--news table script
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
                        `id` int NOT NULL AUTO_INCREMENT,
                        `title` varchar(255) NOT NULL,
                        `category` varchar(100) DEFAULT 'General',
                        `detail` text,
                        `gameId` int DEFAULT 0,
                        `createdDate` date DEFAULT (now()),
                        `img_url_news` varchar(255) DEFAULT NULL,
                        PRIMARY KEY (`id`),
                        FOREIGN KEY (`gameId`) REFERENCES `game` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--insert values in news table
INSERT INTO `news` (`id`,`title`, `category`, `detail`, `game_id`, `createdDate`, `img_url_news`)
    VALUES (1, 'Special End of Year 2021 News Quiz', 'Sword Art Online : Fatal Bullet' , 'How closely did you pay attention to the events of this dramatic year? See what you remember by taking our special 2021 news quiz, divided into four seasons. Our Weekly News Quiz for Students will resume on Tuesday, Jan. 11. Look for a new Learning Network quiz every Tuesday morning during the school year',
            1, '2021-10-23', '/assets/images/favicon.png');

--comments table script
DROP TABLE IF EXISTS `news`;
CREATE TABLE `comments` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `comment` text NOT NULL,
                            `newsId` int NOT NULL,
                            PRIMARY KEY (`id`),
                            FOREIGN KEY (`newsId`) REFERENCES `news` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--insert values in news table
INSERT INTO comments(`id`,`comment`,`news_id`)
    VALUES (1, 'What you remember by taking our special 2021 news quiz, divided into four seasons.', 1);


--user table script
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
                        `id` int NOT NULL AUTO_INCREMENT,
                        `firstName` varchar(100) NOT NULL,
                        `lastName` varchar(100) NOT NULL,
                        `userName` varchar(100) NOT NULL,
                        `email` varchar(100) NOT NULL,
                        `password` varchar(100) NOT NULL,
                        `isAdmin` bool DEFAULT false,
                        PRIMARY KEY (`id`)

)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--insert values in user table
INSERT INTO `user`(`firstName`, `lastName`, `userName`, `email`, `password`, `isAdmin`)
VALUES ('Juili', 'Churi', 'juilichuri19', 'juilichuri19@gmail.com',
        SHA1('Jui@adi19'), true);


-- Structure de la table `item`
--

CREATE TABLE `item` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `item`
--

INSERT INTO `item` (`id`, `title`) VALUES
(1, 'Stuff'),
(2, 'Doodads');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

