-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 09 2020 г., 11:44
-- Версия сервера: 5.5.62
-- Версия PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cabinet`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `login` varchar(17) NOT NULL,
  `password` varchar(250) NOT NULL,
  `hash` varchar(250) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `role_id` int(5) NOT NULL,
  `status` int(5) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`login`, `password`, `hash`, `name`, `surname`, `gender`, `birth_date`, `role_id`, `status`, `id`) VALUES
('user1', '$2y$10$7JJlaUc4hSa2v2EnElAiN.oOeIdqszfsozgbzt6nukA4kD.WpmCXi', NULL, 'name1', 'surname1', '1', '2017-04-03', 1, 0, 1),
('user2', '$2y$10$7JJlaUc4hSa2v2EnElAiN.oOeIdqszfsozgbzt6nukA4kD.WpmCXi', NULL, 'name2', 'surname2', '1', '2000-10-23', 1, 0, 2),
('user3', '$2y$10$7JJlaUc4hSa2v2EnElAiN.oOeIdqszfsozgbzt6nukA4kD.WpmCXi', NULL, 'name3', 'surname3', '1', '2000-10-23', 1, 1, 3),
('user4', '$2y$10$7JJlaUc4hSa2v2EnElAiN.oOeIdqszfsozgbzt6nukA4kD.WpmCXi', NULL, 'name4', 'surname4', '0', '2002-10-23', 2, 1, 4),
('user5', '$2y$10$7JJlaUc4hSa2v2EnElAiN.oOeIdqszfsozgbzt6nukA4kD.WpmCXi', NULL, 'name5', 'surname5', '1', '2000-10-26', 1, 0, 5),
('user6', '$2y$10$7JJlaUc4hSa2v2EnElAiN.oOeIdqszfsozgbzt6nukA4kD.WpmCXi', NULL, 'name6', 'surname6', '0', '2000-10-23', 1, 1, 6),
('user7', '$2y$10$7JJlaUc4hSa2v2EnElAiN.oOeIdqszfsozgbzt6nukA4kD.WpmCXi', NULL, 'name7', 'surname7', '0', '2007-10-23', 2, 1, 7),
('user8', '$2y$10$7JJlaUc4hSa2v2EnElAiN.oOeIdqszfsozgbzt6nukA4kD.WpmCXi', NULL, 'name8', 'surname8', '1', '1900-10-23', 1, 0, 8),
('user3', '$2y$10$7JJlaUc4hSa2v2EnElAiN.oOeIdqszfsozgbzt6nukA4kD.WpmCXi', NULL, 'name3', 'surname3', '1', '2000-10-23', 1, 1, 9),
('user10', '$2y$10$7JJlaUc4hSa2v2EnElAiN.oOeIdqszfsozgbzt6nukA4kD.WpmCXi', NULL, 'name1', 'surname1', '0', '2007-10-23', 2, 1, 10),
('user11', '$2y$10$7JJlaUc4hSa2v2EnElAiN.oOeIdqszfsozgbzt6nukA4kD.WpmCXi', NULL, 'name2', 'surname2', '1', '2000-10-23', 1, 0, 11),
('user12', '$2y$10$7JJlaUc4hSa2v2EnElAiN.oOeIdqszfsozgbzt6nukA4kD.WpmCXi', NULL, 'name3', 'surname3', '1', '2000-10-23', 1, 1, 12);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
