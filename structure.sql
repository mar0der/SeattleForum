-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2014 at 02:25 AM
-- Server version: 5.5.35
-- PHP Version: 5.3.10-1ubuntu3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `myMVC`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--
CREATE DATABASE IF NOT EXISTS `myMVC`;
USE `myMVC`;
CREATE TABLE IF NOT EXISTS `data` (
  `dataid` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`dataid`),
  KEY `dataid` (`dataid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`dataid`, `text`) VALUES
(1, 'test123'),
(2, 'test12345'),
(3, 'Peter');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` enum('guest','user','owner') NOT NULL DEFAULT 'guest',
  `first_name` varchar(32) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `role`, `first_name`) VALUES
(1, 'root', '48c6b75eaf2f7f76896ad192a98f4f2eb7c29fea2c4739cf5cf18126e084c34d', 'owner', 'Peter'),
(2, 'john', '48c6b75eaf2f7f76896ad192a98f4f2eb7c29fea2c4739cf5cf18126e084c34d', 'user', 'Johnny');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
