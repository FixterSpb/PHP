-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 16 2020 г., 12:30
-- Версия сервера: 8.0.20
-- Версия PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `phpdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `name` varchar(20) NOT NULL,
  `path` varchar(64) NOT NULL,
  `size` varchar(11) NOT NULL,
  `popul` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `name`, `path`, `size`, `popul`) VALUES
(244, 'Картинка 01.jpg', '01.jpg', '1024 x 780', 2),
(245, 'Картинка 02.jpg', '02.jpg', '1024 x 780', 1),
(246, 'Картинка 03.jpg', '03.jpg', '1024 x 780', 8),
(247, 'Картинка 04.jpg', '04.jpg', '1024 x 780', 6),
(248, 'Картинка 05.jpg', '05.jpg', '1024 x 780', 3),
(249, 'Картинка 06.jpg', '06.jpg', '1024 x 780', 2),
(250, 'Картинка 07.jpg', '07.jpg', '1024 x 780', 1),
(251, 'Картинка 08.jpg', '08.jpg', '1024 x 780', 7),
(252, 'Картинка 09.jpg', '09.jpg', '1024 x 780', 2),
(253, 'Картинка 10.jpg', '10.jpg', '1024 x 780', 2),
(254, 'Картинка 11.jpg', '11.jpg', '1024 x 780', 1),
(255, 'Картинка 12.jpg', '12.jpg', '1024 x 780', 4),
(256, 'Картинка 13.jpg', '13.jpg', '1024 x 780', 1),
(257, 'Картинка 14.jpg', '14.jpg', '1024 x 780', 7),
(258, 'Картинка 15.jpg', '15.jpg', '1024 x 780', 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=274;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
