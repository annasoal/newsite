<?php
    function print_tree($pages, $shift = 0)
    {
        if (!empty($pages)) {
            foreach ($pages as $page) {
                echo '<li class="list-group-item">';
                for ($i = 0; $i < $shift; $i++) {
                    echo '&nbsp;';
                }
                echo '<a href="/' . ADMIN_URL . '/page/edit/' . $page['id_page'] . '">'
                    . $page['title'] . ' ' . $page['full_url'] . '</a>
                 <a class="badge btn btn-danger" href="/' . ADMIN_URL . '/page/delete/'
                    . $page['id_page'] . '"> Удалить </a>';
                echo '</li>';
                print_tree($page['children'], $shift + 5);
            }
        }
    }
?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#allposts" data-toggle="tab">Посты</a></li>
    <li><a href="#alltags" data-toggle="tab">Теги</a></li>
    <li><a href="#staticpages" data-toggle="tab">Страницы</a></li>
    <li><a href="#images" data-toggle="tab">Изображения</a></li>
    <?
    if ($active_user['role'] == 'Admin') {
        //var_dump($active_user['role']);
        echo '
    <li><a href="#allusers" data-toggle="tab">Пользователи</a></li>
    <li><a href="#allroles" data-toggle="tab">Роли</a></li>
    <li><a href="#allprivs" data-toggle="tab">Привилегии</a></li>
    ';
    }
    ?>
</ul>
<div id="myTabContent" class="tab-content">

    <div class="tab-pane fade in active" id="allposts">
        <h3> Добавление и редактирование постов</h3>
        <div class="jumbotron">
            <a class="btn btn-warning" href="/<?= ADMIN_URL ?>/post/all">Все посты</a>
            <a class="btn btn-success" href="/<?= ADMIN_URL ?>/post/add">Добавить пост</a>
        </div>
    </div>
    <div class="tab-pane fade" id="alltags">
        <h3> Добавление и редактирование тегов</h3>
        <div class="jumbotron">
          <a class="btn btn-warning" href="/<?= ADMIN_URL ?>/tags/all">Теги</a>
        </div>
    </div>

    <div class="tab-pane fade" id="staticpages">
        <h3> Добавление и редактирование страниц</h3>
        <div class="jumbotron">
            <ul class="list-group">

                <? print_tree($pages) ?>
            </ul>
            <a class="btn btn-success" href="/<?= ADMIN_URL ?>/page/add">Добавить страницу</a>
        </div>
    </div>
    <div class="tab-pane fade" id="images">
        <h3> Редактирование изображений</h3>
        <div class="jumbotron">
            <a class="btn btn-warning" href="/<?= ADMIN_URL ?>/images/all">Изображения</a>
        </div>
    </div>
    <? if ($active_user['role'] == 'Admin') {
        echo '
    <div class="tab-pane fade in" id="allusers">
        <h3> Добавление и редактирование пользователей</h3>
        <div class="jumbotron">
            <a class="btn btn-warning" href="/' . ADMIN_URL . '/user/all">Все пользователя</a>
            <a class="btn btn-success" href="/' . ADMIN_URL . '/user/add">Добавить пользователя</a>
        </div>
    </div>
    <div class="tab-pane fade in" id="allroles">
        <h3> Добавление и редактирование ролей пользователей</h3>
        <div class="jumbotron">
            <a class="btn btn-warning" href="/' . ADMIN_URL . '/role/all">Все роли</a>
            <a class="btn btn-success" href="/' . ADMIN_URL . '/role/add">Добавить роль</a>
            </div>
    </div>
    <div class="tab-pane fade in" id="allprivs">
        <h3> Добавление и редактирование привилегий</h3>
        <div class="jumbotron">
            <a class="btn btn-warning" href="/' . ADMIN_URL . '/priv/all">Привилегии</a>
        </div>
    </div> ';
    }
    ?>

</div>