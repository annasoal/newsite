<?foreach ($users as $user): ?>
    <div class="jumbotron">
        <h2><?php echo $user['name']; ?> </h2>
        <br>
        <article>
            <?php
            echo '<img src="' . $user['file'] . '" alt="">';
            echo '<br>';
            echo $user['password'];
            echo '<br>';
            echo $user['email'];
            echo '<br>';
            echo $user['datebirth'];
            ?>

            <?php if(is_array($roles[$user['id_user']])): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">Роли</div>
                    <div class="panel-body">
                        <?php foreach ($roles[$user['id_user']] as $role): ?>
                            <div><a href="/<?ADMIN_URL?>/user/role/<?php echo $role['id_role']; ?>"><?php echo $role['name'];
                                    ?></a></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <? endif; ?>
        </article>

        <a class="btn btn-success btn-sm" href="/<?ADMIN_URL?>/user/one/<?php echo $user['id_user'] ?>">
            Подробнее
        </a>
        <a class="btn btn-primary btn-sm" href="/<?ADMIN_URL?>/user/edit/<?php echo $user['id_user'] ?>">
            Редактировать
        </a>
        <a class="btn btn-danger btn-sm" href="/<?ADMIN_URL?>/user/delete/<?php echo $user['id_user'] ?>">
            Удалить
        </a>

    </div>
<?php endforeach; ?>