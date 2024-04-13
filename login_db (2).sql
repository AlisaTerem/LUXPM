-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 09 2024 г., 19:04
-- Версия сервера: 10.4.32-MariaDB
-- Версия PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `login_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `checki`
--

CREATE TABLE `checki` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `data_vremya` datetime NOT NULL,
  `prais_list_id` int(11) NOT NULL,
  `stoimost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `checki`
--

INSERT INTO `checki` (`id`, `users_id`, `data_vremya`, `prais_list_id`, `stoimost`) VALUES
(1, 26, '2024-04-02 14:50:47', 2, 300),
(2, 20, '2024-04-02 14:50:47', 2, 345),
(3, 26, '2024-04-01 15:51:28', 2, 123);

-- --------------------------------------------------------

--
-- Структура таблицы `mastera`
--

CREATE TABLE `mastera` (
  `id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `mastera`
--

INSERT INTO `mastera` (`id`, `title`, `users_id`) VALUES
(1, 'парикмахер Алиса', 26),
(2, 'мастер ПМ Евгения', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `otziv`
--

CREATE TABLE `otziv` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `otziv` text NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `otziv`
--

INSERT INTO `otziv` (`id`, `users_id`, `otziv`, `data`) VALUES
(1, 32, 'классный мастер.!!!!!!', '2024-04-04 14:05:25'),
(2, 32, 'классный мастер.!!!!!!', '2024-04-04 14:06:17'),
(3, 32, '', '2024-04-04 14:06:20'),
(4, 32, '', '2024-04-04 14:06:20'),
(5, 32, 'dgdfki', '2024-04-04 14:07:04'),
(6, 32, 'чудо мастер!!!!!!!!!', '2024-04-04 14:17:07'),
(7, 32, 'ты классная', '2024-04-04 14:33:31');

-- --------------------------------------------------------

--
-- Структура таблицы `prais_list`
--

CREATE TABLE `prais_list` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL COMMENT 'название услуги',
  `tip_strigki_id` int(11) NOT NULL,
  `dlina_volos_id` int(11) NOT NULL,
  `stoimost` int(10) NOT NULL,
  `time` int(11) NOT NULL COMMENT 'продолжительност выполнения услуги',
  `mastera_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `prais_list`
--

INSERT INTO `prais_list` (`id`, `title`, `tip_strigki_id`, `dlina_volos_id`, `stoimost`, `time`, `mastera_id`) VALUES
(2, 'бритье наголо', 1, 1, 300, 31, 1),
(4, 'мужская стрижка', 1, 1, 900, 60, 1),
(5, 'женская стрижка', 2, 3, 1000, 60, 1),
(7, 'подравнивание волос', 2, 3, 600, 30, 1),
(8, 'подравнивание волос', 2, 3, 600, 30, 1),
(9, 'стрижка челки', 2, 1, 200, 15, 1),
(10, 'стрижка под насадку', 1, 1, 300, 30, 1),
(11, 'детская стрижка', 1, 1, 500, 30, 1),
(12, 'подравнивание волос для девочки', 2, 2, 500, 30, 1),
(13, 'окрашивание в один тон (короткие)', 2, 1, 3000, 120, 1),
(14, 'окрашивание в один тон(средняя длина волос)', 2, 2, 3500, 120, 1),
(15, 'окрашивание в один тон(длинные)', 2, 3, 4500, 180, 1),
(16, 'мелирование(короткие волосы)', 2, 1, 4500, 120, 1),
(17, 'мелирование волос(средней длины)', 2, 2, 5500, 120, 1),
(18, 'мелирование(длинные волосы)', 2, 3, 6500, 120, 1),
(19, 'перманентный макияж бровей', 0, 0, 8000, 120, 2),
(20, 'перманентный макияж губ', 0, 0, 8000, 120, 2),
(21, 'перманентный макияж межресничн', 0, 0, 8000, 120, 2),
(22, 'удаление татуажа лазером', 0, 0, 2000, 30, 2),
(23, 'удаление тату(1 сеанс)', 0, 0, 3000, 30, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `e_mail` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `is_client` int(1) NOT NULL DEFAULT 1,
  `birthday` date DEFAULT NULL,
  `reg_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `e_mail`, `phone`, `password_hash`, `is_client`, `birthday`, `reg_date`) VALUES
(1, 'Карина', 'assdddf@mail.ru', NULL, '$2y$10$emVc1W.wnonIQ3MOb1XHvO.v9ag30IrguJj1GB9dS2uSrjU2L8qzS', 1, NULL, '2024-04-01'),
(7, 'drtdttf', 'asslolldddf@mail.ru', NULL, '$2y$10$/v2IpVctMX/AzV0WFpk78e8/SN3o4b/QcEzTRr3bWp66WtJQJRfCy', 1, NULL, '2024-04-01'),
(8, 'alisa', 'assuopldddf@mail.ru', NULL, '$2y$10$wtm4tDx8IVxF5L/QHZkdce1gENiuC49M1CVdMx0KxdLYRtMl1zTVa', 1, NULL, '2024-04-01'),
(10, 'qwe', 'fh@jhuh.ru', NULL, '$2y$10$r7i7wqBZyHX1fvHTOZ2qyO4QvbJksHPWo37nyGWt7b.p6QZqbvZb6', 1, NULL, '2024-04-01'),
(12, 'iuhikj', 'f8h@jhuh.ru', NULL, '$2y$10$l9q1KARXmbu7O3kkwBtWXeNbEvCllFvbqJqVsVTiiYES7YHBq.rca', 1, NULL, '2024-04-01'),
(14, 'iuhikj', 'f8h@jhuhyuru', NULL, '$2y$10$fz4fFOT3NUtiIgzfOxwwq.sG0BThVgB9t7KcsreWL47D93gaBa9PG', 1, NULL, '2024-04-01'),
(20, 'uuopp', 'fuiiijh@mail.ru', NULL, '$2y$10$Q4uGgOSy3MK0fwHU3UgTKecdE0xGkEyxsLpLNAIg99G0mbul.Nuwe', 1, NULL, '2024-04-01'),
(22, 'Nina', 'f@mail.ru', NULL, '$2y$10$QbmgmryyQPiop9MlDWvibOegY9gfhUe19fQmI2t4ceIg2MBQjikD2', 1, NULL, '2024-04-01'),
(24, 'knklmklm', 'lisenok1535@mail.com', NULL, '$2y$10$XIARzPEGAX9zz4jwRuEaOuX3HlSCbs4JMkd7izx973rwj5HQHjGmG', 1, NULL, '2024-04-01'),
(26, 'Alisa', 'dahjfh@mail.ru', NULL, '$2y$10$g69UVhDyOIR9vBI9xcjkZuHMAyjE.jg8Uk3.M2IqrqUPs25yNdAru', 1, NULL, '2024-04-01'),
(27, 'Pada', 'dsgdxffh@mail.ru', '+79121126666', '$2y$10$yRVEG9qX0PTqs6dup9USvOcrlltC4lKfsA3IGHgEiDPa1J/8ubSFm', 1, NULL, '2024-04-01'),
(30, 'Pada', 'qwexffh@mail.ru', '+79121126669', '$2y$10$oljYdmMtdEszEFvtBmkbI.Z1sbnFLvw9GRyhnPB5VOA1l5ryAtqAm', 1, NULL, '2024-04-01'),
(31, 'маша', 'jmhkllhjfh@mail.ru', '+79124567878', '$2y$10$QYX8rr/7rGkK930P36TkgO/Ibm4A.J0i8h19AJse7I0LtLt/XlF9S', 1, NULL, '2024-04-03'),
(32, 'нина', 'lkkokllhjfh@mail.ru', '34567890789', '$2y$10$PdH219TeTOLlWLUbwk6gxepKRsa5T1f2cEPp6BuKyTHV7JKakDgWC', 1, NULL, '2024-04-03'),
(33, 'alina', 'uijokollhjfh@mail.ru', '+789056432', '$2y$10$Pe5zW/ohoeW/qaSG9UOtweQXPC3zLhB1Onp7f6tzZD3znIwU43Umu', 1, NULL, '2024-04-05');

-- --------------------------------------------------------

--
-- Структура таблицы `zayavka`
--

CREATE TABLE `zayavka` (
  `id` int(10) NOT NULL,
  `vremya_nachala` datetime(6) NOT NULL,
  `vremya_okonchania` datetime(6) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `mastera_id` int(11) DEFAULT NULL,
  `prais_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `zayavka`
--

INSERT INTO `zayavka` (`id`, `vremya_nachala`, `vremya_okonchania`, `users_id`, `mastera_id`, `prais_id`) VALUES
(3, '2018-06-26 15:15:00.000000', NULL, 32, NULL, 2),
(4, '0000-00-00 00:00:00.000000', '2024-04-04 15:05:00.000000', 32, NULL, 2),
(5, '2024-04-06 01:08:04.000000', '2024-04-06 01:08:04.000000', 33, 1, 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `checki`
--
ALTER TABLE `checki`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prais_list_id` (`prais_list_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Индексы таблицы `mastera`
--
ALTER TABLE `mastera`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Индексы таблицы `otziv`
--
ALTER TABLE `otziv`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `prais_list`
--
ALTER TABLE `prais_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tip_strigki` (`tip_strigki_id`),
  ADD KEY `dlina_volos` (`dlina_volos_id`),
  ADD KEY `mastera_id` (`mastera_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `e_mail` (`e_mail`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Индексы таблицы `zayavka`
--
ALTER TABLE `zayavka`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `mastera_id` (`mastera_id`),
  ADD KEY `prais_id` (`prais_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `checki`
--
ALTER TABLE `checki`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `mastera`
--
ALTER TABLE `mastera`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `otziv`
--
ALTER TABLE `otziv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `prais_list`
--
ALTER TABLE `prais_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT для таблицы `zayavka`
--
ALTER TABLE `zayavka`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `checki`
--
ALTER TABLE `checki`
  ADD CONSTRAINT `checki_ibfk_1` FOREIGN KEY (`prais_list_id`) REFERENCES `prais_list` (`id`),
  ADD CONSTRAINT `checki_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `mastera`
--
ALTER TABLE `mastera`
  ADD CONSTRAINT `mastera_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `prais_list`
--
ALTER TABLE `prais_list`
  ADD CONSTRAINT `prais_list_ibfk_1` FOREIGN KEY (`mastera_id`) REFERENCES `mastera` (`id`);

--
-- Ограничения внешнего ключа таблицы `zayavka`
--
ALTER TABLE `zayavka`
  ADD CONSTRAINT `zayavka_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `zayavka_ibfk_2` FOREIGN KEY (`mastera_id`) REFERENCES `mastera` (`id`),
  ADD CONSTRAINT `zayavka_ibfk_3` FOREIGN KEY (`prais_id`) REFERENCES `prais_list` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
