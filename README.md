# Галлерея изображений на PHP

Сделано в качестве практического задания на курсе **PHP**

### Примененные технологии
* PHP, Bootstrap 5.3

### Реализованный функционал

* Вынос всех настроек в файл bootstrap.php
* Авторизация.
* Возможность правки профиля пользователя.
* Просмотр галереи изображений и комментариев без авторизации.        
* Просмотр конкретного изображения в несжатом формате.
* Возможность добавления и удаление изображений для владельца изображений.
* Возможность добавления и удаление комментариев для владельца изображений.
* Удаление всех файлов и комментариев при удалении относящегося к ним изображения.

## Как запустить проект:
1. Создать в MySQL базу project.
2. Создать таблицы:
CREATE TABLE `users` (
  `id` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `images` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `comments` (
  `id` int NOT NULL,
  `id_img` int NOT NULL,
  `post` varchar(255) NOT NULL,
  `owner_username` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
3. Поместить код в папку локального сервера localhost
4. Запустить файл index.php

## TODO:
1. Сохранение регистрации в cookie.
2. Единая точка входа.
3. Пагинация.



