<?php

require_once '../bootstrap.php';
$user = new User;
$images = new Images();
$db = Database::getInstance();
if(Input::exists('get')) {
    $id_image = Input::get('id');
    $image = $images->getImage($id_image)->name; 
}
if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $db->insert(Config::get('comments.table'), ['id_img' => $id_image, 'post' => htmlspecialchars($_POST['comment']), 'owner_username' => $user->data()->username]);
    }   
}
$comments = $db->get(Config::get('comments.table'), ['id_img', '=', $id_image])->results();

//Redirect::to('../index.php');

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

    <?= Session::showFlash(); ?>

    <img src="\uploads\img\<?= $image ?>" class="img-fluid"> 
  
    <hr>
    <?php if(!empty($comments)): ?>
        <table class="table table-striped">
            <tbody>
            <?php foreach ($comments as $post): ?>
                <tr>
                    <td><?= $post->date ?></td><td><?= $post->owner_username ?></td><td><?= $post->post ?></td>
                </tr>
            <?php endforeach; ?>
            <tbody>
        </table>
    <br>
    <?php endif; ?>
    <form action="" method="post" class="card p-2">
        <div class="field" class="col-12">
            <label for="" class="form-label">Ваш комментарий:</label>
            <input type="text" name="comment" class="form-control">
        </div>
        <br>      
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"> 
        <div class="mb-3">
            <button type="submit" class="btn btn-primary mb-3">Отправить</button>
        </div>
    </form>
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

    <img src="\uploads\img\<?= $image ?>" class="img-fluid"> 
    
    <hr>
    <?php if(!empty($comments)): ?>
        <table class="table table-striped">
            <tbody>
            <?php foreach ($comments as $post): ?>
                <tr>
                    <td><?= $post->date ?></td><td><?= $post->owner_username ?></td><td><?= $post->post ?></td>
                </tr>
            <?php endforeach; ?>
            <tbody>
        </table>
    <br>
    <?php endif; ?>

<?php endif; ?>
</div>
</body>
</html>

