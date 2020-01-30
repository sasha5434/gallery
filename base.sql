-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Янв 30 2020 г., 19:08
-- Версия сервера: 5.7.29-0ubuntu0.18.04.1
-- Версия PHP: 7.2.24-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `base`
--

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` int(6) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'image'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `date`, `user_id`, `filename`, `type`) VALUES

-- --------------------------------------------------------

--
-- Структура таблицы `queue`
--

CREATE TABLE `queue` (
  `file` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `percentage` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `user_reg_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_hash` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `user_ip` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_reg_date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_login`, `user_password`, `user_reg_email`, `user_email`, `user_hash`, `user_ip`, `user_reg_date`) VALUES

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `queue`
--
ALTER TABLE `queue`
  ADD PRIMARY KEY (`file`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
