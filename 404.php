<?php

require_once 'bootstrap.php';

$user = new User;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="/css/style.css" rel="stylesheet">
    <title>Галерея изображений</title>
</head>
<body>
<div class="container">
<?php if($user->isLoggenIn()): ?>
    <nav>
        <ul class="menu-main">
            <li><a href="/">Приветствуем, <?= $user->data()->username ?></a></li>
            <li><a href="/view/update.php">Обновить профиль</a></li>
            <li><a href="/view/changepass.php">Изменить пароль</a></li>
            <li><a href="/view/logout.php">Выход</a></li>
        </ul>
    </nav>
    <hr>

    <img src="\css\404.jpg" class="img-fluid"> 

<?php endif; ?>

<?php if(!$user->isLoggenIn()): ?>

    <nav>
        <ul class="menu-main">
            <li><a href="/">Приветствуем, незнакомец</a></li>
            <li><a href="/view/login.php">Войти</a></li>
            <li><a href="/view/register.php">Регистрация</a></li>
        </ul>
    </nav>
    <hr>

    <img src="\css\404.jpg" class="img-fluid"> 

<?php endif; ?>
</div>
</body>
</html>

