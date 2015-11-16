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

<div class="jumbotron">
    <? if ($errors != null):
        foreach ($errors as $e): ?>
            <p class="error"><?= $e; ?></p>
        <?php endforeach;?>
    <? endif; ?>
    <? if ($pages != null):?>
    <h3>Для удаления страницы необходимо изменить url или удалить дочерние страницы</h3>
    <ul class="list-group">
        <? print_tree($pages) ?>
    </ul>
    <? endif ?>

</div>

