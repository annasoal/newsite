<?foreach ($posts as $post): ?>
    <div class="jumbotron">
        <h2><?php echo $post['title']; ?> </h2>
        <br>
        <article>
            <?php
            echo '<img src="' . $post['file'] . '" alt="">';
            echo '<br>';
            echo $post['text'];
            ?>

            <?php if(is_array($tags[$post['id_post']])): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">Теги</div>
                    <div class="panel-body">
                        <?php foreach ($tags[$post['id_post']] as $tag): ?>
                            <div><a href="/<?=ADMIN_URL?>/post/tag/<?php echo $tag['id_tag']; ?>"><?php echo $tag['name'];
                                    ?></a></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <? endif; ?>
        </article>

        <a class="btn btn-success btn-sm" href="/<?ADMIN_URL?>/post/one/<?php echo $post['id_post'] ?>">
            Подробнее
        </a>
        <a class="btn btn-primary btn-sm" href="/<?ADMIN_URL?>/post/edit/<?php echo $post['id_post'] ?>">
            Редактировать
        </a>
        <a class="btn btn-danger btn-sm" href="/<?ADMIN_URL?>/post/delete/<?php echo $post['id_post'] ?>">
            Удалить
        </a>

    </div>
<?php endforeach; ?>