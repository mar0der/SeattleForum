-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Време на генериране: 10 дек 2014 в 23:47
-- Версия на сървъра: 5.5.40
-- Версия на PHP: 5.3.10-1ubuntu3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данни: `seattleForum`
--

-- --------------------------------------------------------

--
-- Структура на таблица `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `question_id` int(10) NOT NULL,
  `creator_id` int(10) NOT NULL,
  `body` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL,
  `edit_date` datetime NOT NULL,
  `score` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура на таблица `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура на таблица `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `dataid` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`dataid`),
  KEY `dataid` (`dataid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Ссхема на данните от таблица `data`
--

INSERT INTO `data` (`dataid`, `text`) VALUES
(1, 'test123'),
(2, 'test12345'),
(3, 'Peter'),
(6, 'asdf'),
(8, 'gjhg');

-- --------------------------------------------------------

--
-- Структура на таблица `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `creator_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `create_date` datetime NOT NULL,
  `edit_date` datetime NOT NULL,
  `subject` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `body` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `score` smallint(5) NOT NULL,
  `visites` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `creator_id` (`creator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура на таблица `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tab_id` int(10) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`tab_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура на таблица `tags_questions`
--

CREATE TABLE IF NOT EXISTS `tags_questions` (
  `question_id` int(10) NOT NULL,
  `tag_id` int(11) NOT NULL,
  KEY `question_id` (`question_id`,`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `role` enum('guest','user','owner') NOT NULL DEFAULT 'guest',
  `first_name` varchar(32) NOT NULL,
  `registered_on` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `score` smallint(4) NOT NULL DEFAULT '0',
  `gender` enum('male','female','unknown') NOT NULL DEFAULT 'unknown',
  `ip` varchar(20) NOT NULL,
  `avatar` varchar(64) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Ссхема на данните от таблица `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `email`, `role`, `first_name`, `registered_on`, `last_login`, `score`, `gender`, `ip`, `avatar`) VALUES
(1, 'root', '48c6b75eaf2f7f76896ad192a98f4f2eb7c29fea2c4739cf5cf18126e084c34d', '', 'owner', 'Peter', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'unknown', '', ''),
(2, 'john', '48c6b75eaf2f7f76896ad192a98f4f2eb7c29fea2c4739cf5cf18126e084c34d', '', 'user', 'Johnny', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'unknown', '', ''),
(3, 'admin', '48c6b75eaf2f7f76896ad192a98f4f2eb7c29fea2c4739cf5cf18126e084c34d', '', 'owner', 'admincho', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'unknown', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
