# Галерея изображений на PHP

Сделано в качестве практического задания на курсе **PHP**

### Примененные технологии
* PHP, ООП, Bootstrap 5.3

### Реализованный функционал

* Идеалогия ООП (MVC).
* Вынос всех настроек в файл bootstrap.php
* Вынос объявления классов в контейнер Dependency Injection
* Верстка на базе стилей Bootstrap 5.
* Авторизация.
* Хранение паролей в виде хешей. 
* Установка требований безопасности к новым паролям (длина, сложность).
* Возможность правки профиля пользователя и смены пароля.
* Просмотр галереи изображений и комментариев без авторизации.        
* Просмотр конкретного изображения в несжатом формате.
* Возможность добавления и удаление изображений для владельца изображений.
* Возможность добавления и удаление комментариев для владельца комментария.
* Удаление всех файлов и комментариев при удалении относящегося к ним изображения.
* Вывод флеш сообщений о выполнении операции.
* Верификация ввода данных кодированным токеном.
* Защита от ввода спецсимволов в комментариях. 
* Запоминание регистрации в cookie.

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
  `owner_id` INT NOT NULL,
  `owner_username` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `user_sessions` (
  `user_id` int NOT NULL,
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
3. Поместить код в папку локального сервера localhost
4. Запустить файл index.php

## TODO:
1. Пагинация.



