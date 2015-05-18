-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 17, 2015 at 06:04 PM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pharmacy_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `city` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city`) VALUES
(1, 'Nicosia'),
(2, 'Larnaca'),
(3, 'Limassol'),
(4, 'Paphos'),
(5, 'Ammochostos');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `title` varchar(240) NOT NULL,
  `date_created` datetime NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `title`, `date_created`, `status`) VALUES
(1, 'A company test', '0000-00-00 00:00:00', '1'),
(2, 'X company test', '0000-00-00 00:00:00', '1'),
(3, 'A Company test', '2015-05-16 00:00:00', '0'),
(4, 'Z Company test', '2015-05-28 00:00:00', '0'),
(5, 'F Company Test', '2015-05-03 00:00:00', '1'),
(6, 'K Company test', '2015-05-28 00:00:00', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

CREATE TABLE IF NOT EXISTS `pharmacy` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(240) NOT NULL,
  `lastname` varchar(240) NOT NULL,
  `title` varchar(240) NOT NULL,
  `city` int(1) NOT NULL,
  `address` varchar(400) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `alternative_phone` varchar(20) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`id`, `name`, `lastname`, `title`, `city`, `address`, `phone_number`, `alternative_phone`, `status`, `date_created`) VALUES
(14, 'Andros', '', 'Latsia Pharmacy', 1, 'Anatolis 63 Kallithea, Dali', '+35796556428', '', '1', '2015-05-17 17:47:54'),
(15, '', '', 'Latsia Pharmacy', 1, 'Anatolis 63 Kallithea, Dali', '+35796556428', '', '1', '2015-05-17 17:48:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(140) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `username`, `password`, `status`, `date_created`) VALUES
(1, 'Andreas', 'Kyriacou', 'andros', '10741596b43b2699f5fecf12b19eb920', '1', '2015-05-09 17:32:33');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
