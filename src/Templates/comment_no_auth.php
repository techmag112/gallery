    <nav>
        <ul class="menu-main">
            <li><a href="/">Приветствуем, незнакомец</a></li>
            <li><a href="/login">Войти</a></li>
            <li><a href="/register">Регистрация</a></li>
        </ul>
    </nav>
    <hr>

    <img src="public\uploads\img\<?= $image ?>" class="img-fluid"> 

    <hr>
    <?php if(!empty($comments)): ?>
        <table class="table table-striped">
            <tbody>
            <?php foreach ($comments as $post): ?>
                <tr>
                    <td></td><td><?= $post->date ?></td><td><?= $post->owner_username ?></td><td><?= $post->post ?></td>
                </tr>
            <?php endforeach; ?>
            <tbody>
        </table>
    <br>
    <?php endif; ?>


