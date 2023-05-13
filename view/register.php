<?php

require_once '../bootstrap.php';

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
            'email' => [
                'required' => true,
                'email' => true,
                'unique' => 'users'
            ],
            'password' => [
                'required' => true,
                'min' => 3,
            ],
            'password_again' => [
                'required' => true,
                'matches' => 'password',
            ],
        ]);

        if($validation->passed()) {

            $user = new User();
            $user->create([
                'username' => Input::get('username'),
                'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
                'email' => Input::get('email'),
            ]);

            Session::setFlash("Регистрация успешно выполнена");
            Redirect::to('login.php');

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
    <title>Document</title>
</head>
<body>
<div class="container">
<form action="" method="post" class="card p-2">
        <?= Session::showFlash();  ?>
        <div class="col-12">
            <label for="username" class="form-label">Никнейм</label>
            <input type="text" name="username" class="form-control" value="<?php echo Input::get('username')?>">
        </div>

        <div  class="col-12">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" value="<?php echo Input::get('email')?>">
        </div>

        <div  class="col-12">
            <label for="" class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control">
        </div>
        
        <div  class="col-12">
            <label for="" class="form-label">Пароль еще раз</label>
            <input type="password" name="password_again" class="form-control">
        </div>
        <br>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"> 
        <div class="field">
            <button type="submit" class="w-100 btn btn-primary btn-lg">Сохранить</button>
        </div>
        
</form>
</div>
</body>
</html>