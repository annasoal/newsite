<div class="jumbotron">
    <h2><?php echo $post['title']; ?> </h2>
    <br>
    <article>
        <?php echo $post['text']; ?>
        <br>
        <img src="<? echo $post['file']; ?>" alt="">

        <?php if (!empty($tags)): ?>
            <div class="panel panel-default">
                <div class="panel-heading">Теги</div>
                <div class="panel-body">
                    <?php foreach ($tags as $tag): ?>
                        <div>
                            <a href="/<?= ADMIN_URL ?>/post/tag/<?php echo $tag['id_tag']; ?>"><?php echo $tag['name']; ?></a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <? endif; ?>
    </article>

    <a class="btn btn-primary btn-sm" href="/<?= ADMIN_URL ?>/post/edit/<?php echo $post['id_post'] ?>">
        Редактировать
    </a>
    <a class="btn btn-danger btn-sm" href="/<?= ADMIN_URL ?>/post/delete/<?php echo $post['id_post'] ?>">
        Удалить
    </a>

</div>