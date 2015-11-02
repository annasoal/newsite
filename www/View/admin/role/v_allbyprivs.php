<?foreach ($users as $user): ?>
    <div class="jumbotron">
        <h2><?php echo $role['name']; ?> </h2>
        <br>
        <article>
            <?php

            echo $role['description'];
            ?>
            <?php if(is_array($roles[$user['id_role']])): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">Роли</div>
                    <div class="panel-body">
                        <?php foreach ($roles[$user['id_role']] as $role): ?>
                            <div><a href="/user/role/<?php echo $role['id_role']; ?>"><?php echo $role['name'];
                                    ?></a></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <? endif; ?>
        </article>

        <a class="btn btn-success btn-sm" href="/<?ADMIN_URL?>/user/one/<?php echo $post['id_post'] ?>">
            Подробнее
        </a>
        <a class="btn btn-primary btn-sm" href="/<?ADMIN_URL?>/user/edit/<?php echo $post['id_post'] ?>">
            Редактировать
        </a>
        <a class="btn btn-danger btn-sm" href="/<?ADMIN_URL?>/user/delete/<?php echo $post['id_post'] ?>">
            Удалить
        </a>

    </div>
<?php endforeach; ?>