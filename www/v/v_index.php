<div class="jumbotron">

    <ol>
        <?php foreach($posts as $key => $t): ?>
            <li><?php echo  $t;?>
                <br>
                <button class="btn btn-danger btn-sm">
                    <a href="/admin/editForm/<?php echo $key+1?>">Редактировать</a>
                </button>
            </li>
        <?php endforeach; ?>
    </ol>
</div>