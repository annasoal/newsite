<?php
    function print_tree($pages, $shift = 0)
    {
        if (!empty($pages)) {
            foreach ($pages as $page) {
                echo '<li>';
                for ($i = 0; $i < $shift; $i++) {
                    echo '&nbsp;';
                }
                echo '<a href="/' . ADMIN_URL . '/page/edit/' . $page['id_page'] . '">'
                    . $page['title'] . ' ' . $page['full_url'] . '</a>';
                echo '</li>';
                print_tree($page['children'], $shift + 5);
            }
        }
    }
?>


<ul class="nav nav-tabs">
    <li class="active"><a href="#staticpages" data-toggle="tab">Страницы</a></li>
    <li><a href="#allposts" data-toggle="tab">Посты</a></li>
    <li><a href="#alltags" data-toggle="tab">Теги</a></li>
    <li><a href="#allusers" data-toggle="tab">Пользователи</a></li>
    <li><a href="#allroles" data-toggle="tab">Роли</a></li>
    <li><a href="#allprivs" data-toggle="tab">Привилегии</a></li>

</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade in active" id="staticpages">
        <h3> Добавление и редактирование страниц</h3>

        <div class="jumbotron">
            <ul class="nav nav-pills nav-stacked">
            <? print_tree($pages) ?>
            </ul>
        </div>
        <a class="btn btn-success" href="/<?= ADMIN_URL ?>/page/add">Добавить страницу</a>
    </div>
    <div class="tab-pane fade" id="allposts">

    </div>
    <div class="tab-pane fade" id="alltags">

    </div>
    <div class="tab-pane fade" id="allusers">
        <div class="tab-pane fade in active" id="staticpages">
            <h3> Добавление и редактирование пользователей</h3>

            <a class="btn btn-warning" href="/<?= ADMIN_URL ?>/user/all">Все пользователя</a>
            <a class="btn btn-success" href="/<?= ADMIN_URL ?>/user/add">Добавить пользователя</a>
        </div>
    </div>
</div>