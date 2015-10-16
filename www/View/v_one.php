<div class="jumbotron">
    <h2><?php echo $title; ?> </h2>
    <br>
    <article><?php
        echo $text;
        echo '<br>';
        echo '<img src="' . $file . '" alt="">';
        ?>
    </article>

    <a class="btn btn-primary btn-sm" href="/adminPost/edit/<?php echo $id_post ?>">
        Редактировать
    </a>
    <a class="btn btn-danger btn-sm" href="/adminPost/delete/<?php echo $id_post ?>">
        Удалить
    </a>

</div>