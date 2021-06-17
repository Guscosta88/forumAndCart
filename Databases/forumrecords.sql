-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 27, 2021 at 04:16 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forumrecords`
--

-- --------------------------------------------------------

--
-- Table structure for table `records_categories`
--

DROP TABLE IF EXISTS `records_categories`;
CREATE TABLE IF NOT EXISTS `records_categories` (
  `category_ID` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) DEFAULT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`category_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records_categories`
--

INSERT INTO `records_categories` (`category_ID`, `category_name`, `description`) VALUES
(1, 'Rock', 'Rock and Roll is a heavier style'),
(2, 'Reggae', 'Reggae Originates in Jamaica'),
(3, 'Rap', 'Rap is a political style'),
(4, 'Blues', 'Blues started in america'),
(5, 'Jazz', 'Jazz has metal instruments');

-- --------------------------------------------------------

--
-- Table structure for table `records_posts`
--

DROP TABLE IF EXISTS `records_posts`;
CREATE TABLE IF NOT EXISTS `records_posts` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `post_text` text,
  `post_create_time` datetime DEFAULT NULL,
  `post_owner` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records_posts`
--

INSERT INTO `records_posts` (`post_id`, `topic_id`, `post_text`, `post_create_time`, `post_owner`) VALUES
(13, 13, 'Help, I need somebody', '2021-05-19 11:02:38', 'john_lennon@beatles.com.uk'),
(14, 13, 'I am here to help you John!', '2021-05-19 11:14:49', 'paul_mccartney@beatles.uk'),
(15, 14, 'But I swear it was in self defence!', '2021-05-19 11:17:28', 'Bob_Marley@Jamaica.com.jm'),
(16, 15, 'mmm', '2021-05-19 11:35:54', 'Muddy_waters@mississippi.com'),
(17, 16, 'mmm', '2021-05-19 11:36:12', 'Muddy_waters@mississippi.com'),
(18, 17, 'I wanna jamming with you', '2021-05-19 11:36:45', 'Bob_Marley@Jamaica.com.jm'),
(19, 17, 'Yeah', '2021-05-19 11:42:54', 'Petter_tosh@jamaica.jm'),
(20, 17, 'ewf', '2021-05-19 11:49:45', 'Petter_tosh@jamaica.jm'),
(21, 18, 'gwrrg', '2021-05-19 11:50:15', 'www@ggg.com'),
(22, 17, 'kuiyg', '2021-05-25 08:37:11', 'Petter_tosh@jamaica.jm'),
(23, 19, 'ouiyg', '2021-05-25 08:38:18', 'gustavo_leon88@hotmail.com'),
(24, 20, 'ouiyg', '2021-05-25 08:38:44', 'gustavo_leon88@hotmail.com'),
(25, 20, 'zsedtghndg', '2021-05-25 08:38:55', 'Petter_tosh@jamaica.jm'),
(26, 21, 'warehg', '2021-05-25 08:39:14', 'gustavo_leon88@hotmail.com'),
(27, 21, 'gfn', '2021-05-26 15:16:17', 'Petter_tosh@jamaica.jm'),
(28, 21, 'erh', '2021-05-26 15:22:02', 'Petter_tosh@jamaica.jm'),
(29, 22, 'wet', '2021-05-26 15:22:20', 'gustavo_leon88@hotmail.com'),
(30, 22, 'wet', '2021-05-26 15:22:40', 'Petter_tosh@jamaica.jm'),
(31, 22, 'wet', '2021-05-26 15:22:51', 'wet@aerh.com'),
(32, 23, 'wefg', '2021-05-26 15:23:12', 'fff@srth.com'),
(33, 24, 'dertfh', '2021-05-26 15:32:53', 'sb-xgyqh5135417@personal.example.com'),
(34, 24, 'swrh', '2021-05-26 15:33:07', 'Petter_tosh@jamaica.jm'),
(35, 25, 'sera nao sei', '2021-05-26 23:01:32', 'gus@gus.com'),
(36, 26, 'nao sei sera', '2021-05-26 23:02:40', 'na@hs.com'),
(37, 27, 'sera', '2021-05-26 23:03:27', 'nao@a.com'),
(38, 28, 'nkadsfn', '2021-05-26 23:04:04', 'hah@jde.com'),
(39, 29, 'oakdo', '2021-05-26 23:04:29', 'rock@rock.com'),
(40, 29, 'erggt', '2021-05-27 14:06:03', 'Petter_tosh@jamaica.jm'),
(41, 30, 'thth6', '2021-05-27 14:06:49', 'gustavo_leon88@hotmail.com'),
(42, 30, '4thht', '2021-05-27 14:07:02', 'Petter_tosh@jamaica.jm');

-- --------------------------------------------------------

--
-- Table structure for table `records_topics`
--

DROP TABLE IF EXISTS `records_topics`;
CREATE TABLE IF NOT EXISTS `records_topics` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_title` varchar(150) DEFAULT NULL,
  `topic_create_time` datetime DEFAULT NULL,
  `topic_owner` varchar(150) DEFAULT NULL,
  `category_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`topic_id`),
  KEY `category_ID` (`category_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `records_topics`
--

INSERT INTO `records_topics` (`topic_id`, `topic_title`, `topic_create_time`, `topic_owner`, `category_ID`) VALUES
(13, 'Help', '2021-05-19 11:02:38', 'john_lennon@beatles.com.uk', 1),
(14, 'I Shot the Sheriff', '2021-05-19 11:17:28', 'Bob_Marley@Jamaica.com.jm', 1),
(15, 'Mannish Boy', '2021-05-19 11:35:54', 'Muddy_waters@mississippi.com', 1),
(16, 'Mannish Boy', '2021-05-19 11:36:12', 'Muddy_waters@mississippi.com', 1),
(17, 'jamming', '2021-05-19 11:36:45', 'Bob_Marley@Jamaica.com.jm', 1),
(18, 'feefew', '2021-05-19 11:50:15', 'www@ggg.com', 3),
(19, 'I Shot the Sheriff', '2021-05-25 08:38:18', 'gustavo_leon88@hotmail.com', 1),
(20, 'I Shot the Sheriff', '2021-05-25 08:38:44', 'gustavo_leon88@hotmail.com', 1),
(21, 'I Shot the Sheriff', '2021-05-25 08:39:14', 'gustavo_leon88@hotmail.com', 1),
(22, 'wet', '2021-05-26 15:22:20', 'gustavo_leon88@hotmail.com', 1),
(23, 'wef', '2021-05-26 15:23:12', 'fff@srth.com', 1),
(24, 'dsfh', '2021-05-26 15:32:53', 'sb-xgyqh5135417@personal.example.com', 1),
(25, 'sera nao sei', '2021-05-26 23:01:32', 'gus@gus.com', 5),
(26, 'nao sei seera', '2021-05-26 23:02:40', 'na@hs.com', 4),
(27, 'sera', '2021-05-26 23:03:27', 'nao@a.com', 3),
(28, 'ndni', '2021-05-26 23:04:04', 'hah@jde.com', 2),
(29, 'haha', '2021-05-26 23:04:29', 'rock@rock.com', 1),
(30, 'egt', '2021-05-27 14:06:49', 'gustavo_leon88@hotmail.com', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
