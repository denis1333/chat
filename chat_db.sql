-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 09 2018 г., 19:17
-- Версия сервера: 10.1.35-MariaDB
-- Версия PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `chat_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `name` char(50) COLLATE utf8_bin NOT NULL,
  `creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`id`, `name`, `creator`) VALUES
(1, 'chat1', 1),
(2, 'chat2', 1),
(3, 'coolChat', 1),
(7, 'coolChat2', 1),
(8, 'coolChat3', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `text` text COLLATE utf8_bin NOT NULL,
  `user` int(11) NOT NULL,
  `chat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `message`
--

INSERT INTO `message` (`id`, `text`, `user`, `chat`) VALUES
(1, 'asfasfasf', 1, 1),
(2, 'asfasfasf', 1, 1),
(3, 'hello', 1, 1),
(4, '123123', 15, 1),
(5, 'asdasd', 15, 1),
(6, 'dfgdfg', 15, 1),
(7, 'dfg', 15, 2),
(8, 'dfgdgf', 15, 3),
(9, 'dfgdfg', 15, 7),
(10, 'dfgdfg', 15, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nick` char(50) COLLATE utf8_bin NOT NULL,
  `pass` char(50) COLLATE utf8_bin NOT NULL,
  `mail` char(50) COLLATE utf8_bin NOT NULL,
  `token` char(255) COLLATE utf8_bin NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `nick`, `pass`, `mail`, `token`, `time`) VALUES
(1, 'asf', 'afasf', 'asfasf', 'a579853e50ba7c41ccfbc3728a5cd21f', 1536432063),
(2, 'afasf', 'afsasf', 'afasf', '0', 0),
(5, 'v1', 'afasf@fasf.asf', 'afasfas', '0', 0),
(8, 'v1aa', 'afasf@fasf.asfasd', 'afasfasasd', '0', 0),
(9, 'v1aass', 'afasf@fasf.asfasddd', 'afasfasasdss', '0', 0),
(10, 'v1aasssd', 'afasf@fasf.asfasdddsd', 'afasfasasdsssd', '0', 0),
(11, 'asd', 'asdasd', 'asdasd', '0', 0),
(12, 'sdfasd', 'sdfasd', 'sdfasd', '', 0),
(13, 'var', 'var', 'var', '', 0),
(14, 'dadsf', 'dadsf', 'dadsf', '', 0),
(15, 'rewr', '1234', 'qwer', 'eb0f64e922d1423f53307b23dcab6fc0', 1539103590),
(16, 'asdas', 'dasdas', 'dasdas', '', 0),
(17, 'qweqwe', 'qeqw', '123123', '', 0),
(18, 'qwrqw', 'wrqwrqr', 'rqwrq', '', 0),
(19, 'qwerqwe', 'qwerqwer', 'rqwer', '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user_in_chat`
--

CREATE TABLE `user_in_chat` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `chat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `user_in_chat`
--

INSERT INTO `user_in_chat` (`id`, `user`, `chat`) VALUES
(1, 1, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `creator` (`creator`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `chat` (`chat`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nick` (`nick`,`mail`);

--
-- Индексы таблицы `user_in_chat`
--
ALTER TABLE `user_in_chat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_2` (`user`,`chat`),
  ADD KEY `user` (`user`),
  ADD KEY `chat` (`chat`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `user_in_chat`
--
ALTER TABLE `user_in_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`chat`) REFERENCES `chat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_in_chat`
--
ALTER TABLE `user_in_chat`
  ADD CONSTRAINT `user_in_chat_ibfk_1` FOREIGN KEY (`chat`) REFERENCES `chat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_in_chat_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
