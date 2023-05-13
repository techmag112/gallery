<?php

require_once 'bootstrap.php';

$user = new User;
$images = new Images();
if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $images->putImage($_FILES['file'], $user->data()->id);   
    }
}    

$gallery = $images->getAllImage();

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

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php foreach($gallery as $image): ?>
        <div class="col">
          <div class="card shadow-sm">
            <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="\uploads\img\<?= $image->name ?>" role="img" aria-label="Placeholder: Эскиз" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/></img>

            <div class="card-body">
              <p class="card-text">Краткое описание.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.location='./view/comment.php?id=<?=$image->id?>'">Комментарии</button>
                  <?php if(($image->owner) == ($user->data()->id)): ?>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.location='./view/del_image.php?id=<?=$image->id?>'">Удалить</button>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
    </div>
    <br>
    <form action="" method="post" enctype="multipart/form-data" class="card p-2">
        <div class="form-file form-file-lg mb-3">
            <input type="file" name="file" class="form-file-input" id="customFileLg">
        </div> 
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"> 
        <div class="mb-3">
            <button type="submit" class="btn btn-primary mb-3">Загрузить</button>
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

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php foreach($gallery as $image): ?>
        <div class="col">
          <div class="card shadow-sm">
            <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="\uploads\img\<?= $image->name ?>" role="img" aria-label="Placeholder: Эскиз" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/></img>

            <div class="card-body">
              <p class="card-text">Краткое описание.</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.location='./view/comment.php?id=<?=$image->id?>'">Комментарии</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
    </div>

<?php endif; ?>
</div>
</body>
</html>

