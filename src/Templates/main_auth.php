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

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <?php foreach($gallery as $image): ?>
        <div class="col">
          <div class="card shadow-sm">
            <?php if(($image->owner) == ($id_user)): ?>
              <a href='/?id=<?=$image->id?>' onclick="return window.confirm('Вы уверены, что хотите удалить?')">
            <?php endif; ?>
              <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="<?= Config::get('images.path') . $image->name ?>" role="img" aria-label="Placeholder: Эскиз" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/></img>
            <?php if(($image->owner) == ($id_user)): ?>  
              </a>
            <?php endif; ?>

            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.location='/comment?id=<?=$image->id?>'">Комментарии</button>
                  <?php if(($image->owner) == ($id_user)): ?>
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="if (confirm('Вы уверены, что хотите удалить?')) { document.location='/?id=<?=$image->id?>' } ">Удалить</button>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
    </div>
    <br>
    <form action="/" method="post" enctype="multipart/form-data" class="card p-2">
        <div class="form-file form-file-lg mb-3">
            <input type="file" name="file" class="form-file-input" id="customFileLg">
        </div> 
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>"> 
        <div class="mb-3">
            <button type="submit" class="btn btn-primary mb-3">Загрузить</button>
        </div>
    </form>