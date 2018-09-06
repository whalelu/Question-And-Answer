-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 2018-09-06 04:43:21
-- 服务器版本： 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `questionsandanswers`
--

-- --------------------------------------------------------

--
-- 表的结构 `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `pk_answers` int(200) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fk_questions` int(100) UNSIGNED NOT NULL,
  `answer` varchar(500) NOT NULL,
  `score` int(100) NOT NULL DEFAULT '10',
  PRIMARY KEY (`pk_answers`),
  KEY `fk_questions` (`fk_questions`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `answers`
--

INSERT INTO `answers` (`pk_answers`, `fk_questions`, `answer`, `score`) VALUES
(1, 15, 'russia', 22),
(2, 15, 'South Africa', 6),
(3, 15, 'beijing', 5),
(13, 13, 'Rocket', 10),
(12, 13, 'warriors', 10),
(14, 13, 'lakers', 10);

-- --------------------------------------------------------

--
-- 表的结构 `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `pk_questions` int(100) UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` varchar(500) NOT NULL,
  `createTime` date NOT NULL,
  `is_answered` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pk_questions`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `questions`
--

INSERT INTO `questions` (`pk_questions`, `question`, `createTime`, `is_answered`) VALUES
(1, 'Which city is the capital of United State?', '2018-04-11', 0),
(16, 'Given two words word1 and word2, find the minimum number of operations required to convert word1 to word2.\r\nYou have the following 3 operations permitted on a word:\r\n1.Insert a character\r\n2.Delete a character\r\n3.Replace a character', '2018-05-04', 0),
(14, 'Who is Bill Gates?', '2018-05-03', 0),
(15, 'Where will the 2018 World Cup take place?', '2018-05-03', 1),
(13, 'Which team is the champion of the nba in 2017?', '2018-04-25', 1),
(49, 'Who is the second man on the moon?', '2018-05-06', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
