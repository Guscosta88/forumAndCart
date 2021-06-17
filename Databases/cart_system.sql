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
-- Database: `cart_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section_ID` varchar(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `product_code` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=193 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `inventory_ID` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(11) NOT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  PRIMARY KEY (`inventory_ID`),
  KEY `product_code` (`product_code`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_ID`, `product_code`, `stock_quantity`) VALUES
(1, '11', 16),
(2, '12', 12),
(3, '13', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pmode` varchar(50) NOT NULL,
  `products` varchar(255) NOT NULL,
  `amount_paid` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `address`, `pmode`, `products`, `amount_paid`) VALUES
(22, 'gus', 'gus@gus.com', '123', '123 street', 'cod', 'Led Zeppelin - Houses of the Holy(7), Pearl Jam - Ten(7), Ramones - Mondo Bizarro(7)', '2660'),
(23, 'gus', 'gus@gus.com', '123', '123 gus', 'cod', 'Led Zeppelin - Houses of the Holy(7), Pearl Jam - Ten(7), Ramones - Mondo Bizarro(7)', '2660'),
(24, 'gus', 'gus@gus.com', '123', '123 gus', 'cod', 'Led Zeppelin - Houses of the Holy(7), Pearl Jam - Ten(7), Ramones - Mondo Bizarro(7)', '2660'),
(25, 'doe', 'john@fdo.com', '123', '123street', 'cod', 'Led Zeppelin - Houses of the Holy(8), Pearl Jam - Ten(8), Ramones - Mondo Bizarro(8)', '3040'),
(26, 'john', 'doe@john.com', '123', '123 gagaga', 'cod', 'Led Zeppelin - Houses of the Holy(3), Pearl Jam - Ten(3), Ramones - Mondo Bizarro(3)', '1140'),
(27, 'GUS', 'gus@gus.com', '13', '123 street', 'cod', 'Ramones - Mondo Bizarro(2), Pearl Jam - Ten(1)', '210'),
(28, 'gus', 'gus@hot.com', '123', '123jsjsj', 'cod', 'Led Zeppelin - Houses of the Holy(1), Pearl Jam - Ten(1), Ramones - Mondo Bizarro(1)', '380'),
(29, 'dd', 'dd@dd.com', '123', '123 strre', 'cod', 'Led Zeppelin - Houses of the Holy(1), Pearl Jam - Ten(1), Ramones - Mondo Bizarro(1)', '380'),
(30, 'gus', 'gus@gus.com', '123', '123 street', 'cod', 'Led Zeppelin - Houses of the Holy(5), Pearl Jam - Ten(5), Ramones - Mondo Bizarro(5)', '1900'),
(31, 'gus', 'gus@gus.com', '1223', '122 street', 'netbanking', 'Led Zeppelin - Houses of the Holy(2), Pearl Jam - Ten(2), Ramones - Mondo Bizarro(2)', '760'),
(32, 'gus', 'gus@gus.com', '123', '123 street', 'cod', 'Led Zeppelin - Houses of the Holy(1), Pearl Jam - Ten(1), Ramones - Mondo Bizarro(1)', '380'),
(33, 'ha', 'ha@ha.com', '123', '123 street', 'cod', 'Led Zeppelin - Houses of the Holy(3), Pearl Jam - Ten(3), Ramones - Mondo Bizarro(3)', '1140'),
(34, 'gus', 'gus@gus.com', '123', '123 street', 'cod', 'Led Zeppelin - Houses of the Holy(5), Pearl Jam - Ten(3), Ramones - Mondo Bizarro(3)', '1640'),
(35, 'gus', 'gus@gus.com', '123', '123 street', 'cod', 'Led Zeppelin - Houses of the Holy(1), Pearl Jam - Ten(1), Ramones - Mondo Bizarro(1)', '380'),
(36, 'hots', 'hots@hot.com', '123', '123 address', 'cod', 'Led Zeppelin - Houses of the Holy(1), Pearl Jam - Ten(1), Ramones - Mondo Bizarro(1)', '380'),
(37, 'gus', 'gus@gus.com', '123', '123 stret', 'cod', 'Led Zeppelin - Houses of the Holy(1), Pearl Jam - Ten(1), Ramones - Mondo Bizarro(1)', '380'),
(38, 'gus', 'gus@gus.com', '123', '123 gs', 'cod', 'Led Zeppelin - Houses of the Holy(1), Pearl Jam - Ten(1), Ramones - Mondo Bizarro(1)', '380'),
(39, 'gus', 'gus@gus.com', '123', '123 ad', 'cod', 'Led Zeppelin - Houses of the Holy(1), Pearl Jam - Ten(1), Ramones - Mondo Bizarro(1)', '380'),
(40, 'gus', 'gus@gus.com', '123', '123 ad', 'cod', 'Led Zeppelin - Houses of the Holy(1), Pearl Jam - Ten(1), Ramones - Mondo Bizarro(1)', '380'),
(41, 'gus', 'gus@gus.com', '123', '123 address', 'cod', 'Led Zeppelin - Houses of the Holy(2), Pearl Jam - Ten(5), Ramones - Mondo Bizarro(6)', '1230'),
(42, 'john', 'john@doe.com', '1234', '1234 address', 'cod', 'Led Zeppelin - Houses of the Holy(1), Pearl Jam - Ten(1), Ramones - Mondo Bizarro(1)', '380');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `product_qty` int(11) NOT NULL DEFAULT '1',
  `product_image` varchar(255) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_code_2` (`product_code`),
  KEY `product_code` (`product_code`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_price`, `product_qty`, `product_image`, `product_code`) VALUES
(10, 'Led Zeppelin - Houses of the Holy', '250', 1, 'images/led.jpg', '11'),
(11, 'Pearl Jam - Ten', '50', 1, 'images/pearl.jpg', '12'),
(12, 'Ramones - Mondo Bizarro', '80', 1, 'images/ramones.jpg', '13');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
