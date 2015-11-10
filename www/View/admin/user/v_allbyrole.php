<?foreach ($users as $user): ?>
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
            ?>
            <div class="panel panel-default">
                <div class="panel-heading">Роль</div>
                <div class="panel-body">
                    <div>
                        <a href="/<?=ADMIN_URL?>/user/role/<?php echo $user['id_role']; ?>">
                            <?php echo $user['role'];?></a>
                    </div>

                </div>
            </div>
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