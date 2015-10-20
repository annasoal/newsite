<? var_dump($posts);
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

        <div class="panel panel-default">
            <div class="panel-heading">Теги</div>
            <div class="panel-body">
            <?php
                echo $post['name'];
                echo '<br>';

            ?>
            </div>
        </div>
        </article>


        </aside>
        <a class="btn btn-success btn-sm" href="/post/one/<?php echo $post['id_post'] ?>">
            Подробнее
        </a>
        <a class="btn btn-primary btn-sm" href="/adminPost/edit/<?php echo $post['id_post'] ?>">
            Редактировать
        </a>
        <a class="btn btn-danger btn-sm" href="/adminPost/delete/<?php echo $post['id_post'] ?>">
            Удалить
        </a>

    </div>
<?php endforeach; ?>

<ul class="pagination">
    <?php for($i = 1; $i <= $pages_count; $i++): ?>
        <?php if($i == $page): ?>
        <li class="active"><a href="/post/page/<?php echo $i; ?>"><?php echo $i; ?></a>
        <? else: ?>
            <li><a href="/post/page/<?php echo $i; ?>"><?php echo $i; ?></a></li>
        <?php endif; ?>
    <?php endfor; ?>
</ul>