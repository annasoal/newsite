-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 26 2015 г., 15:17
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id_image`, `file`, `date`) VALUES
(11, '/images/12079470_501949103308490_6954766548849410363_n.jpg', '2015-10-14 14:54:45'),
(13, '/images/12079470_501949103308490_6954766548849410363_n.jpg', '2015-10-14 16:47:59'),
(14, '/images/background-15933_640.jpg', '2015-10-14 18:26:47'),
(15, '/images/12088009_500866653416735_6281055393724545069_n.jpg', '2015-10-14 19:38:56'),
(16, '/images/Bright_Spring_Flower_Garden.jpg', '2015-10-16 13:48:33'),
(21, '/images/spring_announcement.jpg', '2015-10-23 10:59:23'),
(22, '/images/spring_announcement.jpg', '2015-10-23 12:15:19'),
(23, '/images/1880c5ba99e1b315e6b2b6f28dae4d4e.jpg', '2015-10-23 12:15:35'),
(33, '/images/spring_announcement.jpg', '2015-10-26 11:25:12');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=99 ;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id_post`, `title`, `text`, `id_image`, `date`) VALUES
(98, 'iuiuiuoouiopip', 'mmnmnm', 33, '2015-10-26 11:25:12');

-- --------------------------------------------------------

--
-- Структура таблицы `posts_tags`
--

CREATE TABLE IF NOT EXISTS `posts_tags` (
  `id_post` bigint(20) NOT NULL,
  `id_tag` bigint(20) NOT NULL,
  UNIQUE KEY `a` (`id_post`,`id_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts_tags`
--

INSERT INTO `posts_tags` (`id_post`, `id_tag`) VALUES
(87, 5),
(88, 6),
(89, 5),
(90, 1),
(91, 1),
(92, 6),
(92, 9),
(93, 1),
(93, 6),
(93, 9),
(94, 1),
(94, 6),
(94, 9),
(95, 6),
(96, 6),
(97, 6),
(98, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id_tag` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `comment` text,
  PRIMARY KEY (`id_tag`),
  UNIQUE KEY `id_tag` (`id_tag`),
  KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id_tag`, `name`, `comment`) VALUES
(1, 'twrt', 'fcgfchgeweqeqe'),
(5, 'живопись', 'Изображения с картинами маслом цуцйу'),
(6, 'oioioioioi', 'popop'),
(8, 'cscxzc', 'zxczc'),
(9, 'asdas', '');

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
