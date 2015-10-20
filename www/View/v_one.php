<div class="jumbotron">
    <h2><?php echo $post['title']; ?> </h2>
    <br>
    <article>
        <?php echo $post['text'];?>
        <br>
        <img src="<? echo $post['file'];?>" alt="">
    </article>
    <div class="panel panel-default">
        <div class="panel-heading">Теги</div>
        <div class="panel-body">
            <?php foreach ($post['name'] as $tag){
                echo $tag;
                echo '<br>';
            }
            ?>
        </div>
    </div>


    <a class="btn btn-primary btn-sm" href="/adminPost/edit/<?php echo $post['id_post'] ?>">
        Редактировать
    </a>
    <a class="btn btn-danger btn-sm" href="/adminPost/delete/<?php echo $post['id_post'] ?>">
        Удалить
    </a>

</div>