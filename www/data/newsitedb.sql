-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 14 2015 г., 21:31
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `newsitedb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id_image` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_image`),
  UNIQUE KEY `id_image` (`id_image`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id_image`, `file`, `date`) VALUES
(11, '/images/12079470_501949103308490_6954766548849410363_n.jpg', '2015-10-14 14:54:45'),
(12, '/images/12088009_500866653416735_6281055393724545069_n.jpg', '2015-10-14 16:31:58'),
(13, '/images/12079470_501949103308490_6954766548849410363_n.jpg', '2015-10-14 16:47:59'),
(14, '/images/background-15933_640.jpg', '2015-10-14 18:26:47');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id_post` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `text` longtext NOT NULL,
  `id_image` bigint(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_post`),
  UNIQUE KEY `id_post` (`id_post`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id_post`, `title`, `text`, `id_image`, `date`) VALUES
(8, 'ewfwefw', 'wefwefwef', 9, '2015-10-14 13:25:35'),
(9, 'ioiopipoiop 56ytryrtyg tyrtyrtyry', 'itireutietoerittijeritreit jntjertjertko ntejrtrotket jtkejrtoerotke ktjoeokwpekre tkejotkwerkngm jenejkwjerkew', 11, '2015-10-14 14:54:45'),
(10, 'erweteytry', 'weterytrwqwqret', 12, '2015-10-14 16:31:58'),
(11, 'ded 9000-', 'edqd', 14, '2015-10-14 16:47:59');

-- --------------------------------------------------------

--
-- Структура таблицы `post_tag`
--

CREATE TABLE IF NOT EXISTS `post_tag` (
  `id_post` bigint(20) NOT NULL,
  `id_tag` bigint(20) NOT NULL,
  KEY `id_post` (`id_post`,`id_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id_tag` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY (`id_tag`),
  UNIQUE KEY `id_tag` (`id_tag`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_image` bigint(20) NOT NULL,
  `datebirth` date NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `id_user` (`id_user`),
  UNIQUE KEY `email` (`email`),
  KEY `datebirth` (`datebirth`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
