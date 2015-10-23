-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 20 2015 г., 14:41
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id_image`, `file`, `date`) VALUES
(11, '/images/12079470_501949103308490_6954766548849410363_n.jpg', '2015-10-14 14:54:45'),
(12, '/images/12088009_500866653416735_6281055393724545069_n.jpg', '2015-10-14 16:31:58'),
(13, '/images/12079470_501949103308490_6954766548849410363_n.jpg', '2015-10-14 16:47:59'),
(14, '/images/background-15933_640.jpg', '2015-10-14 18:26:47'),
(15, '/images/12088009_500866653416735_6281055393724545069_n.jpg', '2015-10-14 19:38:56'),
(16, '/images/Bright_Spring_Flower_Garden.jpg', '2015-10-16 13:48:33'),
(17, '/images/spring_announcement.jpg', '2015-10-19 21:02:25');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=79 ;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id_post`, `title`, `text`, `id_image`, `date`) VALUES
(8, 'ewfwefw', 'wefwefwef', 15, '2015-10-14 13:25:35'),
(9, 'ioiopipoiop 56ytryrtyg tyrtyrtyry', 'itireutietoerittijeritreit jntjertjertko ntejrtrotket jtkejrtoerotke ktjoeokwpekre tkejotkwerkngm jenejkwjerkew', 11, '2015-10-14 14:54:45'),
(10, 'erweteytry', 'weterytrwqwqret', 12, '2015-10-14 16:31:58'),
(11, 'ded 9000-', 'edqd', 14, '2015-10-14 16:47:59'),
(35, 'gfgbfdg', 'dgdgdfgdf', 0, '2015-10-19 19:45:58'),
(38, 'eetetrtte', 'ertettett rteter rtetettwewfwfw', 0, '2015-10-19 19:54:10'),
(39, 'eetetrtte', 'ertettett rteter rtetettwewfwfw', 0, '2015-10-19 19:55:30'),
(40, 'rtetet', 'ertretete', 0, '2015-10-19 19:56:02'),
(41, 'fgddffg', 'dfgdgdgdgdg', 0, '2015-10-19 20:03:14'),
(42, 'bvbcvb', 'cvbvcbcvbc', 0, '2015-10-19 20:10:39'),
(43, 'fbccvbvcbcb', 'vbcvbvcbcbcb', 0, '2015-10-19 20:17:31'),
(44, 'rttd', 'rttretet', 0, '2015-10-19 20:19:54'),
(45, 'rttd', 'rttretet', 0, '2015-10-19 20:21:58'),
(46, 'fgdg', 'dfgdgdfgd', 0, '2015-10-19 20:22:14'),
(47, 'dfsfsf', 'dfsfsdfsdf', 0, '2015-10-19 20:28:31'),
(48, 'dfsfsf', 'dfsfsdfsdf', 0, '2015-10-19 20:29:15'),
(49, 'dfsfsf', 'dfsfsdfsdf', 0, '2015-10-19 20:41:44'),
(50, 'fgdfg', 'gdgdfgdg', 0, '2015-10-19 20:42:04'),
(51, 'rrtrteteddsccccccccccccccccccccccc', 'ccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc', 0, '2015-10-19 20:44:30'),
(52, 'bvvvvvvvvvv', 'vvvvvvvvvvvvvvvvvvvvvvv', 0, '2015-10-19 20:45:48'),
(53, 'fgewwwwwwwwwwwwwwwww', 'ewwwwwwwwwwwwwwwwwww', 0, '2015-10-19 20:46:41'),
(54, 'ddsssssssssssssssssss', 'dssssssssssssssssss', 0, '2015-10-19 20:47:37'),
(55, 'oiooio', 'klkllkkklklkl', 0, '2015-10-19 20:53:39'),
(56, 'ioioioioiop', 'ooioio', 0, '2015-10-19 20:56:53'),
(57, 'ioioioioiop', 'ooioio', 0, '2015-10-19 20:57:13'),
(58, 'ioioioioiop', 'ooioio', 0, '2015-10-19 20:57:15'),
(59, 'ioioioioiop', 'ooioio', 0, '2015-10-19 20:57:16'),
(60, 'ioioioioiop', 'ooioio', 0, '2015-10-19 20:57:17'),
(61, 'ioioioioiop', 'ooioio', 0, '2015-10-19 20:57:20'),
(62, 'ioioioioiop', 'ooioio', 0, '2015-10-19 20:57:23'),
(63, 'mnmnmnmn', 'i9899898', 0, '2015-10-19 20:58:23'),
(64, 'klklklklk', ';l;l;l;l;l;l''oppipioioip[opopo', 17, '2015-10-19 21:02:25'),
(65, 'ioioipo', 'opop', 0, '2015-10-19 21:07:39'),
(66, ',.,.,.,', 'popiipip', 0, '2015-10-19 21:08:30'),
(67, ',.,.,.,', 'popiipip', 0, '2015-10-19 21:09:29'),
(68, ',.,.,.,', 'popiipip', 0, '2015-10-19 21:09:54'),
(69, ',m,m,m,', ',m,m,,.mikjijoioiopp', 0, '2015-10-19 21:17:24'),
(70, ',m,m,m,m,m,m,m,m', 'oiiiuuuuuuuuuuuuuuuuuuuuuuuuuu', 0, '2015-10-19 21:20:10'),
(71, ',,khihoooooooooooooooo', 'iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii', 0, '2015-10-19 21:30:05'),
(73, 'swqsqsqw', 'qwsqswsqsswq', 0, '2015-10-20 08:47:28'),
(74, 'swqsqsqw', 'qwsqswsqsswq', 0, '2015-10-20 08:53:15'),
(75, 'wdqd', 'qwqewqeqweqe', 0, '2015-10-20 08:56:29'),
(76, 'wdqd', 'qwqewqeqweqe', 0, '2015-10-20 09:00:46'),
(77, 'dwqeqqqqqqqqqq', 'qweeeeeeeeeeeeeeeee', 0, '2015-10-20 09:03:27'),
(78, 'qweqeqwe', 'qwewqeqwe', 0, '2015-10-20 09:04:44');

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
(74, 6),
(77, 1),
(77, 6),
(78, 1),
(78, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id_tag`, `name`, `comment`) VALUES
(1, 'twrt', 'fcgfchgeweqeqe'),
(5, 'живопись', 'Изображения с картинами маслом цуцйу'),
(6, 'oioioioioi', 'popop');

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
