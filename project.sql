-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3400
-- Время создания: Май 14 2023 г., 14:31
-- Версия сервера: 8.0.30
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `id_img` int NOT NULL,
  `post` varchar(255) NOT NULL,
  `owner_id` int NOT NULL,
  `owner_username` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `id_img`, `post`, `owner_id`, `owner_username`, `date`) VALUES
(3, 13, 'Круто!', 1, 'Sirius Sam', '2023-05-13 21:49:28'),
(7, 13, 'Test', 1, 'Sirius Sam', '2023-05-14 10:10:15'),
(8, 13, 'Test2', 1, 'Sirius Sam', '2023-05-14 10:10:21'),
(15, 15, 'sdfdsfdsf', 3, 'Tetra', '2023-05-14 11:08:44'),
(19, 13, 'Privet!', 2, 'Mike', '2023-05-14 14:12:16'),
(20, 15, 'Eeeee!', 2, 'Mike', '2023-05-14 14:12:34'),
(21, 15, 'AAAA', 2, 'Mike', '2023-05-14 14:12:40'),
(22, 18, 'qwwqwwe', 2, 'Mike', '2023-05-14 14:12:57');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `name`, `owner`) VALUES
(13, '645fd70aa1c316brVyEijEcQ.jpg', '1'),
(15, '64606ad158e41^CAF36C7CD3CFECCD7AD54B38CCBA56DAEF650D2F4AF6F34255^pimgpsh_fullsize_distr.jpg', '2'),
(18, '6460c1eb63b9a14494772_1176790282405039_8117098267927735556_n.jpg', '2');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`) VALUES
(1, 'a@a.com', 'Sirius Sam', '$2y$10$Hk5wfLM4kF1N3my8GLeYBOAmlXEprIiDGRyAl58WV/HZrd0gg/TI2'),
(2, 'b@b.com', 'Mike', '$2y$10$OsrY8.Vaq5pFqYzzRcrObuj3SWEG6xB4GmIkG.M8Kcl/d/8w1en2G'),
(3, 'c@c.com', 'TetraPak', '$2y$10$3Ar8mtYwvCcngf9If9nWluQ1vx2qCBzT7uJct77U6o26KSSgOI7d6');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
