<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Название галереи</th>
        <th contentedittable>Дата создания</th>
        <!--//как реализовать???-->
        <th>Загрузить изображения</th>
        <th>Редактировать</th>
        <th>Удалить</th>

    </tr>
    </thead>

    <tbody>
    <?php
    foreach ($galleries as $gallery): ?>
        <tr class="active">
            <td><?php echo $gallery['id_gallery'] ?></td>
            <td><?php echo $gallery['name'] ?></td>
            <td><?php echo $gallery['dt'] ?></td>
            <td><a href="/<?= ADMIN_URL ?>/gallery/upload/<?php echo $gallery['id_gallery'] ?>" class="btn
            btn-success">Загрузить изображения</a></td>
            <td><a href="/<?= ADMIN_URL ?>/gallery/edit/<?php echo $gallery['id_gallery'] ?>" class="btn
            btn-success">Редактировать</a></td>
            <td><a href="/<?= ADMIN_URL ?>/gallery/delete/<?php echo $gallery['id_gallery'] ?>" class="btn btn-danger">Удалить</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<br>
<br>
<? if ($errors != null):
    foreach ($errors as $e): ?>
        <p class="error"><?php echo $e; ?></p>
    <?php endforeach;?>
<?php endif; ?>

<form class="form-horizontal" method="post" action="/<?= ADMIN_URL ?>/gallery/add">
    <fieldset>
        <legend>Добавить галерею</legend>
        <div class="form-group">
            <label for="inputTitle" class="col-lg-2 control-label">Название галереи</label>

            <div class="col-lg-10">
                <input type="text" class="form-control" id="inputTitle" name="name"
                       value="<?php echo $fields['name']; ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="reset" class="btn btn-danger">Очистить</button>
                <button type="submit" class="btn btn-success" name="add">Отправить</button>
            </div>
        </div>
    </fieldset>
</form>
