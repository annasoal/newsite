<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Название тега</th>
        <th contentedittable>Комментарий</th>
        <!--//как реализовать???-->
        <th>Редактировать</th>
        <th>Удалить</th>

    </tr>
    </thead>

    <tbody>
    <?php
    foreach ($tags as $tag): ?>
        <tr class="active">
            <td><?php echo $tag['id_tag'] ?></td>
            <td><?php echo $tag['name'] ?></td>
            <td><?php echo $tag['comment'] ?></td>
            <td><a href="/<?= ADMIN_URL ?>/tag/edit/<?php echo $tag['id_tag'] ?>" class="btn
            btn-success">Редактировать</a></td>
            <td><a href="/<?= ADMIN_URL ?>/tag/delete/<?php echo $tag['id_tag'] ?>" class="btn btn-danger">Удалить</a>
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

<form class="form-horizontal" method="post" action="/<?= ADMIN_URL ?>/tag/add">
    <fieldset>
        <legend>Добавить тег</legend>
        <div class="form-group">
            <label for="inputTitle" class="col-lg-2 control-label">Название тега</label>

            <div class="col-lg-10">
                <input type="text" class="form-control" id="inputTitle" name="name"
                       value="<?php echo $fields['name']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Комментарий</label>

            <div class="col-lg-10">
                <textarea class="form-control" rows="5" id="textArea"
                          name="comment"><?php echo $fields['comment']; ?></textarea>
                <span class="help-block">Для заметок</span>
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
