<div class="jumbotron">
    <h2><?php echo $role['name']; ?> </h2>
    <br>
    <article>
        <?php

        echo $role['description'];
        ?>
        <? if(!empty($privs)): ?>
            <div class="panel panel-default">
                <div class="panel-heading">Теги</div>
                <div class="panel-body">
                    <?php foreach ($privs as $priv): ?>
                        <div><a href="/<?=ADMIN_URL?>/role/priv/<?php echo $priv['id_priv']; ?>"><?php echo
                                $priv['name'];?></a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <? endif; ?>
    </article>

    <a class="btn btn-primary btn-sm" href="/<?=ADMIN_URL?>/role/edit/<?php echo $role['id_role'] ?>">
        Редактировать
    </a>
    <a class="btn btn-danger btn-sm" href="/<?=ADMIN_URL?>/role/delete/<?php echo $role['id_role'] ?>">
        Удалить
    </a>

</div>