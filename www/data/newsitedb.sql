-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 17 2015 г., 14:29
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
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id_comment` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_post` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `text` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `id_comment` (`id_comment`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id_comment`, `id_post`, `id_user`, `text`, `date`) VALUES
(1, 99, 6, 'iioioio', '2015-11-12 09:03:56'),
(7, 99, 6, 'oioi', '2015-11-12 09:16:16'),
(8, 99, 6, 'oioiopoio[p[p[]', '2015-11-12 09:16:24');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id_image` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `alt` text,
  `figcaption` text,
  PRIMARY KEY (`id_image`),
  UNIQUE KEY `id_image` (`id_image`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id_image`, `file`, `date`, `alt`, `figcaption`) VALUES
(15, '/images/12088009_500866653416735_6281055393724545069_n.jpg', '2015-10-14 19:38:56', NULL, NULL),
(16, '/images/Bright_Spring_Flower_Garden.jpg', '2015-10-16 13:48:33', NULL, NULL),
(23, '/images/1880c5ba99e1b315e6b2b6f28dae4d4e.jpg', '2015-10-23 12:15:35', NULL, NULL),
(34, '/images/field_corn_21.jpg', '2015-10-28 08:05:52', NULL, NULL),
(35, '/images/1880c5ba99e1b315e6b2b6f28dae4d4e.jpg', '2015-10-28 08:21:17', NULL, NULL),
(36, '/images/eb170112a4ec4d5e96f12a3cda1920dc.jpg', '2015-11-02 18:01:15', NULL, NULL),
(38, '/images/eb170112a4ec4d5e96f12a3cda1920dc.jpg', '2015-11-09 19:10:33', NULL, NULL),
(43, '/images/field-corn-21.jpeg', '2015-11-16 14:22:11', NULL, NULL),
(45, '/images/field-corn-21.jpeg', '2015-11-16 15:23:41', NULL, NULL),
(46, '/images/field-corn-21.jpeg', '2015-11-16 15:26:42', NULL, NULL),
(47, '/images/field-corn-21.jpeg', '2015-11-16 15:27:50', NULL, NULL),
(48, '/images/field-corn-21_1.jpeg', '2015-11-16 15:28:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id_page` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent` bigint(20) NOT NULL,
  `url` varchar(256) NOT NULL,
  `full_url` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` longtext NOT NULL,
  `base_template` varchar(64) NOT NULL,
  `inner_template` varchar(64) NOT NULL,
  UNIQUE KEY `id_page` (`id_page`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id_page`, `id_parent`, `url`, `full_url`, `title`, `content`, `base_template`, `inner_template`) VALUES
(1, 0, 'contacts', 'contacts', 'Контакты', 'КОНТАКТЫ', 'v_main.php', 'v_main.php'),
(2, 0, 'about', 'about', 'О нас', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias eius eligendi eos error fugit libero maxime, modi\r\nnecessitatibus nihil officiis pariatur provident quos sint tempora tenetur veniam voluptas. Alias,\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid aut consequatur debitis dignissimos distinctio\r\ndolore eum fugit laborum, magnam maiores minima nesciunt nostrum, placeat quaerat qui reprehenderit sequi vitae voluptatum.', 'v_main.php', 'v_main.php'),
(4, 2, 'erwr', 'about/erwr', 'erwr', '<p>wererwerrw</p>', 'v_main.php', 'v_main.php'),
(5, 0, 'qew', 'qew', 'qeqweq', '<p><img alt="" src="/images/field-corn-21" style="width: 1500px; height: 938px;" />​</p>', 'v_main.php', 'v_main.php'),
(6, 0, 'tu', 'tu', 'tyut', '<p><img alt="" src="/images/field-corn-21_2.jpeg" style="width: 1500px; height: 938px;" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><img alt="" src="C:OpenServerdomainsewsitewwwControllerAdmin/../../images/field-corn-21" /></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>rtyurtut</p>', 'v_main.php', 'v_main.php'),
(7, 0, 'iui', 'iui', 'kjkjk', '<p><img alt="" src="/images/field-corn-21_3.jpeg" style="width: 1500px; height: 938px;" /></p>', 'v_excep.php', 'v_main.php');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=110 ;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id_post`, `title`, `text`, `id_image`, `date`) VALUES
(99, 'ter', '<p><strong>rtete</strong></p>', 34, '2015-10-28 08:05:52'),
(101, ';l;l;l', 'l;l;l;yuyuu', 35, '2015-10-28 08:21:17'),
(102, 'iuiuiu 8788988', 'lklkl', 36, '2015-11-02 18:01:15'),
(103, 'ytutyu', '<p>yuytrtyuyt</p>', 39, '2015-11-16 14:18:49'),
(104, 'oopopop', '<p>klklklk</p>', 41, '2015-11-16 14:21:00'),
(105, 'qeqweqeqwe', '<p>klklklk</p>', 43, '2015-11-16 14:22:11'),
(106, 'ioioio', '<p>kjkjkjk</p>', 45, '2015-11-16 15:23:41'),
(107, 'dasad', '<p>asdadadadsd</p>', 46, '2015-11-16 15:26:42'),
(108, 'sdadadad', '<p>adadsdadada</p>', 47, '2015-11-16 15:27:50'),
(109, 'ddad', '<p>adadad</p>', 48, '2015-11-16 15:28:21');

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
(99, 1),
(99, 6),
(99, 9),
(101, 1),
(102, 5),
(102, 6),
(102, 8),
(103, 5),
(104, 5),
(105, 8),
(106, 8),
(107, 6),
(108, 8),
(109, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `privs`
--

CREATE TABLE IF NOT EXISTS `privs` (
  `id_priv` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id_priv`),
  UNIQUE KEY `id_priv` (`id_priv`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `privs`
--

INSERT INTO `privs` (`id_priv`, `name`, `description`) VALUES
(3, 'edit_posts', 'редактирование всех статей, тегов, связанных изображений'),
(4, 'edit_users', 'редактирование пользователей'),
(5, 'edit_rights', 'редактирование прав доступа(роли, привилегии, присвоение ролей пользователям)'),
(6, 'edit_pages', 'создание и редактирование страниц');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id_role` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(128) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id_role`),
  UNIQUE KEY `id_role` (`id_role`),
  UNIQUE KEY `unique_role` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id_role`, `role`, `description`) VALUES
(1, 'Admin', 'Доступ ко всему'),
(3, 'Moderator', 'Доступ к контенту');

-- --------------------------------------------------------

--
-- Структура таблицы `roles_privs`
--

CREATE TABLE IF NOT EXISTS `roles_privs` (
  `id_role` bigint(20) NOT NULL,
  `id_priv` bigint(20) NOT NULL,
  UNIQUE KEY `id_role` (`id_role`,`id_priv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles_privs`
--

INSERT INTO `roles_privs` (`id_role`, `id_priv`) VALUES
(0, 3),
(0, 5),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(3, 3),
(3, 6),
(5, 3),
(6, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id_session` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) NOT NULL,
  `token` text NOT NULL,
  `timestart` datetime NOT NULL,
  `lastactivity` datetime NOT NULL,
  `isover` datetime NOT NULL,
  PRIMARY KEY (`id_session`),
  UNIQUE KEY `id_session` (`id_session`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id_session`, `id_user`, `token`, `timestart`, `lastactivity`, `isover`) VALUES
(1, 8, 'vgM3hmURM0LslE1c6oRz9MXZKwjUWm2IaVIWVvIfNwOtbvrYmuaFNVij8ovvoJtU', '2015-11-09 16:53:12', '2015-11-09 16:53:49', '2015-11-16 16:53:12'),
(4, 8, '3iaxDoqpydxIwVf6kzCHCer9ay4ZINAhG5OEWWp3GT4HbQX66l7hEMMEMjU6G7md', '2015-11-09 17:17:42', '2015-11-09 17:17:42', '2015-11-16 17:17:42'),
(5, 8, '7LBDiNkwKZlmc6wX1DwzFNbS7k40ycWPc99oQixacy4MZfUqxnIAyd3cVLmUj9dG', '2015-11-09 17:18:16', '2015-11-09 17:18:16', '2015-11-16 17:18:16'),
(16, 8, 'pLxu43O8B0T6Um3VpxIEuAprvOYTigMD8v1QJjB71CiBpLgQEWil9t59FbOoXeOb', '2015-11-13 16:15:11', '2015-11-19 14:51:11', '2015-11-20 16:15:11'),
(29, 6, 'rUTEtSNVWBasmhhq2rh3CcbkLa1FfblFprFGZGMDptMaiwAa28wx6XMHAtGTDexS', '2015-11-15 21:27:47', '2015-11-22 00:41:58', '2015-11-22 21:27:47'),
(30, 8, 'elqZpW5W6Z7xIt6n9A3fTHS2Qm9SM8eETtPTcm5oqZq0Ltr17RyzMAmLQKGbLpmb', '2015-11-16 16:33:21', '2015-11-16 16:46:31', '2015-11-23 16:33:21'),
(31, 8, 'auSZNazyqm2rYHR4Xl4HzRJbIb0lbpJKFvWn1Z04RfVZQfOW4xjKvtG1X9BBoMti', '2015-12-16 15:53:15', '2015-12-16 18:30:47', '2015-12-23 15:53:15');

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
-- Структура таблицы `texts`
--

CREATE TABLE IF NOT EXISTS `texts` (
  `id_text` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id_text`),
  UNIQUE KEY `id_text` (`id_text`),
  UNIQUE KEY `unique_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `texts`
--

INSERT INTO `texts` (`id_text`, `text`, `name`) VALUES
(1, '+79030000000', 'phone'),
(2, 'Moscow', 'address');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(64) DEFAULT NULL,
  `id_image` bigint(20) NOT NULL,
  `datebirth` date NOT NULL,
  `id_role` bigint(20) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `id_user` (`id_user`),
  UNIQUE KEY `email` (`email`),
  KEY `datebirth` (`datebirth`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`, `id_image`, `datebirth`, `id_role`) VALUES
(6, 'Ann', 'm1@mail.ru', '7e3f7f2a639d4fa1243be82e9372381a11834ee15e9707bee48c65d000550d61', 38, '1987-12-01', 3),
(8, 'Anna', 'm@mail.ru', '7e3f7f2a639d4fa1243be82e9372381a11834ee15e9707bee48c65d000550d61', 0, '0000-00-00', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
