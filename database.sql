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
-- Create project database
DROP DATABASE IF EXISTS Project2_Gaming;
CREATE DATABASE Project2_Gaming;
USE Project2_Gaming;

-- game table script
DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `name` varchar(500) NOT NULL,
                        `createDate` date NOT NULL,
                        `synopsis` text NOT NULL,
                        `editor` varchar(100) NOT NULL,
                        `genre` varchar(100) NOT NULL,
                        `mode` varchar(150) NOT NULL,
                        `img_url_game` varchar(200) DEFAULT NULL,
                        `video_url` varchar(300) DEFAULT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- insert values into Game table
INSERT INTO `game` (`id`, `name`, `createDate`, `synopsis`, `editor`, `genre`, `mode`, `img_url_game`, `video_url`)
VALUES (1, 'General', '2018-02-23', 'General', 'General', 'RPG', 'Solo, multi Joueur', 'null', 'null');

INSERT INTO `game` (`id`, `name`, `createDate`, `synopsis`, `editor`, `genre`, `mode`, `img_url_game`, `video_url`)
VALUES (2, 'Sword Art Online : Fatal Bullet', '2018-02-23', 'Bienvenue dans un monde armes à feu : Gun Gale Online', 'Bandai Namco Entertainment', 'RPG', 'Solo, multijoueur', '/assets/images/wildGun.png', 'https://www.youtube.com/embed/DgnlWy1lFvo');

INSERT INTO `game` (`id`, `name`, `createDate`, `synopsis`, `editor`, `genre`, `mode`, `img_url_game`, `video_url`)
VALUES (3, 'Basic Math - Fun With Numbers', '1997-09-01','The objective is to solve basic arithmetic problems.','Gary Palmer','Basic Math','Solo',
        '/assets/images/Math_game.png', 'https://www.youtube.com/embed/PkUnwKCFTZ8');



-- news table script
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
                        `id` int NOT NULL AUTO_INCREMENT,
                        `title` varchar(255) NOT NULL,
                        `category` varchar(100) DEFAULT NULL,
                        `detail` text,
                        `gameId` int DEFAULT NULL,
                        `createdDate` datetime DEFAULT NOW(),
                        `img_url_news` varchar(255) DEFAULT NULL,
                        `video_url_news` varchar(255) DEFAULT NULL,
                        PRIMARY KEY (`id`),
                        FOREIGN KEY (`gameId`) REFERENCES `game` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- insert values in news table
INSERT INTO `news` (`id`,`title`, `detail`, `gameId`, `createdDate`, `img_url_news`,`video_url_news`)
VALUES (1, 'Special End of Year 2021 News Quiz', 'How closely did you pay attention to the events of this dramatic year? See what you remember by taking our special 2021 news quiz, divided into four seasons.
Our Weekly News Quiz for Students will resume on Tuesday, Jan. 11. Look for a new Learning Network quiz every Tuesday morning during the school year.The year began with a shocking assault on American democracy, wild amateur investing on Wall Street, a trip to Mars and yet another Superbowl win for a familiar face.
The United States began the new year far behind schedule in its coronavirus vaccine rollout, having distributed shots to a mere fraction of the 20 million people it had hoped to reach by this time, even as the nation hit a grim new milestone on New Year’s Eve: 20 million cases since the start of the pandemic.' where id = 1;
, 1, '2021-10-23 12:10:20', '2021NewsQuizLN-superJumbo.png', 'https://www.youtube.com/embed/PkUnwKCFTZ8');

INSERT INTO `news` (`id`,`title`, `detail`, `gameId`, `createdDate`, `img_url_news`,`video_url_news`)
VALUES (2, 'Destiny 2 Players Can Potentially Lose Their Items Using Destiny Item Manager and Other Apps', 'Destiny 2 players have been relying on Destiny Item Manager and other apps for a while now, and it seems some items were lost due to API issues.Because Destiny 2 is a looter shooter, the way loot can be managed by players is important, which is why the community has been very vocal over the years about increasing vault space. Doing that would allow players to store more items and carefully select which armor pieces they want to keep and which to dismantle, as well as which weapon rolls can be good
enough to keep for later. Still, one of the biggest boons of Destiny 2 is that it allows third-party apps to handle players inventories and vaults in a way that makes it all quite simple and straightforward.Prior to this addition, transferring gear over to alternate characters required players to travel to the Tower, place the items into the vault, log into the other character, travel to the vault once more, and pick up everything. This was incredibly time-consuming, so apps like Destiny Item Manager became extremely popular in the Destiny 2 community. For a long time, it was believed that apps like DIM simply couldnt make items disappear because of how the games API works, but recent evidence proved otherwise.',
        2, '2022-01-11 16:51:20', '/assets/images/destiny-2-players.jpeg', 'https://www.youtube.com/embed/6cX9sP7zRhI');
        
INSERT INTO `news` (`id`, `title`, `category`, `detail`, `gameId`, `createdDate`, `img_url_news`, `video_url_news`)
VALUES (3, 'Z Event - New Record', NULL, '<p style=\"padding-left: 40px;\"><strong>Z Event? </strong></p>\r\n<p style=\"text-align: justify;\">Z Event is a charity project created by Adrien Nougaret and Alexandre Dachary. The goal is to bring together several entertainers specializing in video game streaming over the Internet for a weekend marathon.&nbsp;</p>\r\n<p style=\"text-align: justify;\">Held in Montpelier, the Z Event video game event broke its own world record for charity on Twitch by exceeding <strong>10 million euros in donations</strong>.</p>\r\n<p style=\"text-align: justify;\">Fifty-one streamers played online for 55 hours with a generous community always motivated to take on new challenges.</p>\r\n<p style=\"text-align: justify;\">An edition marked by the sexist slippage of Inoxtag towards its guest, actress Andrea Pedrero. The YouTuber immediately apologized to streamer Ultia`s channel, which was particularly uplifted.</p>\r\n<p>&nbsp;</p>\r\n<p style=\"text-align: right;\"><em>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(Sources : 20 minutes)</em></p>',
        NULL, '2022-01-10 01:07:52', 'https://img-4.linternaute.com/KBVpiCn488LUiC61xjpY0xJjYYc=/1500x/smart/76c7826af6a74c0997919e70f5763708/ccmcms-linternaute/29199047.jpg', NULL);

INSERT INTO `news` (`id`, `title`, `category`, `detail`, `gameId`, `createdDate`, `img_url_news`, `video_url_news`)
VALUES (4, 'Ian Livingstone ennobled', NULL,
        '<p>Ian Livingstone, is now a knight in the eyes of the crown of England. An award for his accomplishments in the video game industry.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Hiro Capital celebrates the award of the knighthood to its co-founding partner, Sir Ian Livingstone, in recognition of his service to video games. The man, was awarded the title of \"Knight Bachelor\" by Queen Elizabeth II.</p>\r\n<p>He had already received in 2000 the \"Honorary Doctorate\" from the University of Abertay Dundee (Scotland), for his services to the world of video games and was made a member of the prestigious Order of the British Empire in 2006.</p>\r\n<p style=\"text-align: right;\"><em>(Sources :&nbsp; Ouest France - Marion BARGIACCHI avec AFP.)</em></p>',
        NULL, '2022-01-05 23:22:29', '/assets/images/IanLivingstone.png', NULL);

INSERT INTO `news` (`id`, `title`, `category`, `detail`, `gameId`, `createdDate`, `img_url_news`, `video_url_news`)
VALUES (5, 'New Wild Game - Basic Math', NULL,
        '<p>Our wild developers are pleased to announce that a new fun game is available.</p>\r\n<p>Have fun while stimulating your brainpower, with Wild Gaming!</p>',
        '2', '2022-01-11 12:03:56', '/assets/images/logo.png', NULL);

-- comments table script
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `comment` text NOT NULL,
                            `newsId` int NOT NULL,
                            PRIMARY KEY (`id`),
                            FOREIGN KEY (`newsId`) REFERENCES `news` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



-- user table script
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

)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- insert values in user table
INSERT INTO `user`(`firstName`, `lastName`, `userName`, `email`, `password`, `isAdmin`)
VALUES ('Admin', 'Account', 'Admin', 'adminaccount@gmail.com',
        SHA1('Admin123456!'), true);

-- comments table script
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `comment` text NOT NULL,
                            `newsId` int NOT NULL,
                            `userId` int NOT NULL,
                            `createdDate` datetime DEFAULT now(),
                            PRIMARY KEY (`id`),
                            FOREIGN KEY (`newsId`) REFERENCES `news` (`id`) ON DELETE CASCADE,
                            FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- insert values in news table
INSERT INTO comments(`id`,`comment`,`newsId`)
VALUES (1, 'What you remember by taking our special 2021 news quiz, divided into four seasons.', 1);



-- Structure de la table `item`
--

CREATE TABLE `item` (
                        `id` int(11) UNSIGNED NOT NULL,
                        `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

