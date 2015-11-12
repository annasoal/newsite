<?php
function print_tree($pages,  $shift = 0)
{
    //var_dump($pages);
    if (!empty($pages)) {
        foreach ($pages as $page) {
            echo '<br>';
            for ($i = 0; $i < $shift; $i++) {
                echo '&nbsp;';
            }
            echo $page['id_page'] . ' ' . $page['title'] . ' ' . $page['full_url'];


            print_tree($page['children'], $shift + 5);

        }
    }
}
?>
<ul class="nav nav-tabs">
    <li class="active"><a href="#staticpages"  data-toggle="tab">Страницы</a></li>
    <li><a href="#allposts" data-toggle="tab">Посты</a></li>
    <li><a href="#alltags" data-toggle="tab">Теги</a></li>
    <li><a href="#allusers" data-toggle="tab">Пользователи</a></li>

</ul>
<div id="myTabContent" class="tab-content">
    <div class="tab-pane fade in active" id="staticpages">
        <h3> Добавление и редактирование страниц</h3>

        <div class="jumbotron">
        <? print_tree($pages) ?>
        </div>
        <a class="btn btn-success" href="/<?=ADMIN_URL?>/page/add">Добавить страницу</a>
    </div>
    <div class="tab-pane fade" id="allposts" >

    </div>
    <div class="tab-pane fade" id="alltags">

    </div>
    <div class="tab-pane fade" id="allusers">

    </div>
</div>