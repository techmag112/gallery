    <nav>
        <ul class="menu-main">
            <li><a href="/">Приветствуем, <?= $username ?></a></li>
            <li><a href="/update">Обновить профиль</a></li>
            <li><a href="/changepass">Изменить пароль</a></li>
            <li><a href="/logout">Выход</a></li>
        </ul>
    </nav>
    <hr>

    <?= Session::showFlash(); ?>

    <img src="<?= Config::get('images.path') . $image ?>" class="img-fluid"> 
  
    <hr>
    <?php if(!empty($comments)): ?>
        <table class="table table-striped">
            <tbody>
            <?php foreach ($comments as $post): ?>
                <tr>
                    <td><?php if($post->owner_id == $id_user): ?><a class="btn btn-danger" onclick="confirm('Вы уверены?');" href="comment?id=<?=$id_image?>&id2=<?=$post->id?>">X</a><?php endif; ?></td>
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

