<?php

require_once '../bootstrap.php';

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();

        $validate->check($_POST, [
            'email' => ['required' => true, 'email' => true],
            'password' => ['required' => true],
        ]);

        if($validate->passed()) {
            $user = new User;
            $remember = (Input::get('remember') === 'on') ? true : false;

            $login = $user->login(Input::get('email'), Input::get('password'), $remember);
            if($login) {
                Redirect::to('../index.php');
            } else {
                Session::setFlash("Неверный логин или пароль!", "danger");
            }
        } else {
            $errors = '';
            foreach ($validate->error() as $error) {
                $errors .= $error . '<br>';
            }
            Session::setFlash($errors, "danger");
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
<form action="" method="post" class="card p-2">

        <?= Session::showFlash();  ?>
       
        <div class="field" class="col-12">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" value="<?php echo Input::get('email')?>">
        </div>

        <div class="field" class="col-12">
            <label for="" class="form-label">Password</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="field">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">Запомнить</label>
        </div>

        <br>      
        <input type="hidden" name="token" class="form-control" value="<?php echo Token::generate(); ?>"> 
        <div class="field">
            <button type="submit" class="w-100 btn btn-primary btn-lg">Войти</button>
        </div>
        
</form>
</div>
</body>
</html>
