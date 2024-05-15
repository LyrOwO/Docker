-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : mer. 15 mai 2024 à 06:46
-- Version du serveur : 11.3.2-MariaDB-1:11.3.2+maria~ubu2204
-- Version de PHP : 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `logs`
--
CREATE DATABASE IF NOT EXISTS `logs` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `logs`;

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

CREATE TABLE `connexion` (
  `id` int(11) NOT NULL,
  `identifiant` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`id`, `identifiant`, `mdp`) VALUES
(19, 'remi', '$2y$10$pBdJOhdcM1pZvoLS4bf3YuJM3zLRFByYQSQZ39dIAdcl0aRznTL82'),
(21, 'ro', '$2y$10$di90cMidjbSmb3X6rOIVZ.Bh.ehRHA9cHZ14i0hxe/n1V8Tcwkr1e'),
(29, 'OKAY', '$2y$10$uxUsojSJ3uPzMHQyWfgIfeCJXQVqrq0bCR9qAJMilwQOINO6Zboku'),
(61, 'test', '$2y$10$Z6LzEvZi8.hZHHTBoSbnkuojtlcrqzxAPRxTToPLk6wHVk4sbvxUS'),
(62, 'remi', '$2y$10$KD7CkpAnAzZclAPvGuX0ze0Fn/GNdJsDFPWkYXuqhVSU7Js5Talfy');

-- --------------------------------------------------------

--
-- Structure de la table `manwha`
--

CREATE TABLE `manwha` (
  `Id_Manwha` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `manwha`
--

INSERT INTO `manwha` (`Id_Manwha`, `titre`, `auteur`, `description`) VALUES
(1, 'Omniscient Reader\'s Viewpoint', 'Sing-Shong', '« Je suis le seul lecteur à connaître la fin du monde. » [Les trois façons de survivre dans un monde en ruine], ce roman fantastique de 3 149 chapitres, est devenu la réalité. Et il n\'existe qu\'une seule personne qui a lu l\'intégralité de l\'ouvrage.'),
(2, 'I Killed an Academy Player', 'GREENKYRIN', 'I killed the player.\r\nHe was a real son of a bitch…'),
(3, 'Pick Me Up, Infinite Gacha', 'Hermode/Cho Wooneh (RedIce Studio)', 'The mobile gacha game ‘Pick Me Up!’ is known for being brutally difficult, and no one has been able to clear a dungeon. Loki, the fifth among all the world’s masters, loses consciousness while trying to clear the dungeon. Upon waking up, Loki finds himself turned into a 1-star level 1 hero, ‘Islat Han’. “It’s him! I’m certain he’s the one who brought me here!” In order to return to Earth, he must lead novice masters and heroes and break through the 100th floor of the dungeon! “You messed with the wrong person.” This is the story of master Loki who is forced to carry everyone to victory and cannot afford a single defeat.'),
(4, 'Reformation of the Deadbeat Noble', 'Second Star', 'Airen Parreira is a boy who sleeps to run away from reality. People mocked him, calling him a ‘deadbeat’, but he had no wish to change. Until one day, he dreamt of a swordsman… It was a dream about a talentless man who had been training by swinging his sword for decades.'),
(5, 'Reaper of the Drifting Moon', 'Woo-Gak', 'He’s in the deepest part of the Jianghu. Keep your eyes wide open if you do not wish to get dragged into the abyss.'),
(6, 'Regressing with the King’s Power', 'Ahn Soseol/ Sunghyun', '“I’ll eat all your skills!”, ‘f*ck this awakening bullshit’, ‘To hell with being a loser.’ Kim Taehyun, whose awakening level remainsThe life of an unawakened, where condescendence, disdain, and harassment are the norm.\r\nDamned loser…\r\nDamned life…\r\nDamned awakening…!And at the damned moment of death, I encountered “King,” a strange being.With blindingly bright light, my second life began.\r\nBut this time, it’s different.\r\nBecause this time, I’m an Awakened too!I will devour those who stand in my way, and I will never bow my head down to someone ever again.'),
(7, 'Reincarnation of the Suicidal Battle God', 'Blue-Deep', 'A time travel action fantasy of the strongest of mankind. “Even if the disgusting gods gave me this chance, an opportunity is still an opportunity. Since they want to end up dead, I will kill them.” The last survivor of mankind, Zephyr. The fight with the demons ended in defeat and the gods gave him a chance to go back 10 years in time. The demons who took everything away from humans and the gods who treated humans as beings for sight-seeing. This time, I will tear them to pieces.'),
(8, 'Return Of The Shattered Constellation', ' Sadoyeon', 'A mere human who ascended to the position of a god, ‘Twilight of the Gods’. After becoming infamous as an Evil God, he lost everything. His Constellation, his faith, and his status. His divinity got cut off, and his divine power disappeared.\r\n\r\n \r\n\r\n“I’d like you to work with me.”\r\n\r\n \r\n\r\nThat’s when the master of the Underworld, Thanatos, offered his hand… After grabbing Thanatos’s hand, ‘Twilight of the Gods’ decided to live again as the player ‘Lee Changseon’ to get back at the gods who threw him down to the underworld!\r\n\r\n \r\n\r\n‘So, I’ve really come back.’'),
(9, 'Return of the SSS-Class Ranker', 'Gald', 'Rokan was the ‘King of Violence’ who reigned as the strongest in the virtual reality game, ‘The Lord’. Unfortunately, the assassination order issued by an enemy guild caused him to lose everything. To his surprise, the next time he woke up, he had returned back to three years ago!\r\n\r\n“Fucking brats, just you wait. I’ll devour you all!”\r\n\r\nA new story begins as Rokan, who travelled back in time, climbs his way back to the top!'),
(10, 'Revenge of the Iron-Blooded Sword Hound', 'I Stepped On Lego', 'He was the hound of the Baskerville family: Vikir.\r\n\r\nYet his loyalty was rewarded by the blade of a guillotine dirtied by slander.\r\n\r\n“I will never live the life of a hound slaughtered after the rabbit is caught.”\r\n\r\nIn place of death, an unexpected opportunity awaits him.\r\n\r\nVikir’s eyes glowed red as he sharpened his canines in the dark.\r\n\r\n“Just you wait, Hugo. I will rip out your throat this time.”\r\n\r\nIt’s time for the hound to exact bloody revenge on his owner.'),
(12, 'Bloodhound’s Regression Instinct', 'acro', '“Yan,” the protagonist, was brainwashed by the emperor and lived as his puppet. After finding out he was being played by the emperor, he planned to seek revenge, but collapsed due to the emperor’s might. He thought he had died, but when he woke up, he realized he had regressed to the time when he was a recruit. Whether to seek revenge on the emperor or to find his family. The choice lay in his hands.'),
(14, 'The Greatest Estate Developer', 'BK_Moon/ Lee hyunmin', 'When civil engineering student Suho Kim falls asleep reading a fantasy novel, he wakes up as a character in the book! Suho is now in the body of Lloyd Frontera, a lazy noble who loves to drink, and whose family is in a mountain of debt. Using his engineering knowledge, Suho designs inventions to avert the terrible future that lies in wait for him. With the help of a giant hamster, a knight, and the world’s magic, can Suho dig his new family out of debt and build a better future?');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `connexion`
--
ALTER TABLE `connexion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `manwha`
--
ALTER TABLE `manwha`
  ADD PRIMARY KEY (`Id_Manwha`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `connexion`
--
ALTER TABLE `connexion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `manwha`
--
ALTER TABLE `manwha`
  MODIFY `Id_Manwha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
