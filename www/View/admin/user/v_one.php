
<div class="jumbotron">
    <h2><?php echo $user['name']; ?> </h2>
    <br>
    <article>
        <?php
        echo '<img src="' . $user['file'] . '" alt="">';
        echo '<br>';
        echo $user['email'];
        echo '<br>';
        echo $user['datebirth'];
        if(!empty($roles)): ?>
            <div class="panel panel-default">
                <div class="panel-heading">Теги</div>
                <div class="panel-body">
                    <?php foreach ($roles as $role): ?>
                        <div><a href="/<?=ADMIN_URL?>/user/role/<?php echo $role['id_role']; ?>"><?php echo
                                $role['name'];
                                ?></a></div>
                    <?php endforeach; ?>
                </div>
            </div>
        <? endif; ?>
    </article>

    <a class="btn btn-primary btn-sm" href="/<?=ADMIN_URL?>/user/edit/<?php echo $user['id_user'] ?>">
        Редактировать
    </a>
    <a class="btn btn-danger btn-sm" href="/<?=ADMIN_URL?>/user/delete/<?php echo $user['id_user'] ?>">
        Удалить
    </a>

</div>