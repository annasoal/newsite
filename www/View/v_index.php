<?php

foreach ($posts as $post): ?>
    <div class="jumbotron">
        <h2><?php echo $post['title']; ?> </h2>
        <br>
        <article>
            <?php
            echo '<img src="' . $post['file'] . '" alt="">';
            echo '<br>';
            echo $post['text'];
            ?>
        </article>
        <a class="btn btn-success btn-sm" href="/pages/one/<?php echo $post['id_post'] ?>">
            Подробнее
        </a>
        <a class="btn btn-primary btn-sm" href="/admin/edit/<?php echo $post['id_post'] ?>">
            Редактировать
        </a>
        <a class="btn btn-danger btn-sm" href="/admin/delete/<?php echo $post['id_post'] ?>">
            Удалить
        </a>


    </div>
<?php endforeach; ?>

