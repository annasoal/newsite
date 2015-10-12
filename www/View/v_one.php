<div class="jumbotron">
    <h2><?php echo $title_post; ?> </h2>
    <br>
    <article><?php
        echo $text_post;
        echo '<br>';
        echo '<img src="' . $imgFile_post . '" alt="' . $imgDescription_post . '">'
        ?>
    </article>

    <a class="btn btn-primary btn-sm" href="/admin/edit/<?php echo $id_post ?>">
        Редактировать
    </a>
    <a class="btn btn-danger btn-sm" href="/admin/delete/<?php echo $id_post ?>">
        Удалить
    </a>

</div>