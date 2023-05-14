<?php

require_once '../bootstrap.php';

$user = new User();

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();

        $validation = $validate->check($_POST, [
            'username' => [
                'required' => true,
                'min' => 2,
                'max' => 15,
                'unique' => 'users'
            ],
        ]);

        if($validation->passed()) {

            $user->update(['username' => Input::get('username')]);

            Session::setflash('Успешно обновлено!');
            Redirect::to('../index.php');
        } else {
            foreach($validation->error() as $error) {
                echo $error . '<br>';
            }
        }
    }
}

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
    <nav>
        <ul class="menu-main">
        <li><a href="/">Приветствуем, <?= $user->data()->username ?></a></li>
        <li><a href="/view/update.php" class="current">Обновить профиль</a></li>
        <li><a href="/view/changepass.php">Изменить пароль</a></li>
        <li><a href="/view/logout.php">Выход</a></li>
        </ul>
    </nav>
    <hr>
    
    <?= Session::showFlash(); ?>

<form action="" method="post" class="card p-2">
        <div class="field" class="col-12">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $user->data()->username ?>">
        </div>
        <br>
        <input type="hidden" name="token" class="form-control" value="<?php echo Token::generate(); ?>"> 
        <div class="field">
            <button type="submit" class="w-100 btn btn-primary btn-lg">Обновить</button>
        </div>
</form>
</div>
</body>
</html>