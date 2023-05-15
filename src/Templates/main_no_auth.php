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
            <img class="bd-placeholder-img card-img-top" width="100%" height="225" src="public/uploads/img/<?= $image->name ?>" role="img" aria-label="Placeholder: Эскиз" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/></img>

            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.location='./view/comment?id=<?=$image->id?>'">Комментарии</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>
    </div>