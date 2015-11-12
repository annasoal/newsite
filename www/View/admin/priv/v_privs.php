
<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th>#</th>
        <th>Название привилегии</th>
        <th contentedittable>Описание</th><!--//как реализовать???-->
        <th>Редактировать</th>
        <th>Удалить</th>

    </tr>
    </thead>

    <tbody>
    <?php
    foreach ($privs as $priv): ?>
        <tr class="active">
            <td><?php echo $priv['id_priv']?></td>
            <td><?php echo $priv['name']?></td>
            <td><?php echo $priv['description']?></td>
            <td><a href="/<?=ADMIN_URL?>/priv/edit/<?php echo $priv['id_priv']?>" class="btn
            btn-success">Редактировать</a></td>
            <td><a href="/<?=ADMIN_URL?>/priv/delete/<?php echo $priv['id_priv']?>" class="btn
            btn-danger">Удалить</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<br>
<br>
<? if($errors != null):
foreach($errors as $e): ?>
    <p class="error"><?php echo $e; ?></p>
<?php endforeach;?>
<?php endif;?>

<form class="form-horizontal" method="post" action="/<?=ADMIN_URL?>/priv/add" >
    <fieldset>
        <legend>Добавить привилегию</legend>
        <div class="form-group">
            <label for="inputTitle" class="col-lg-2 control-label">Название привилегии</label>

            <div class="col-lg-10">
                <input type="text" class="form-control" id="inputTitle" name="name" value="<?php echo $fields['name'];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Описание привилегии</label>

            <div class="col-lg-10">
                <textarea class="form-control" rows="5" id="textArea" name="description"><?php echo
                    $fields['description'];
                    ?></textarea>
                <span class="help-block">Допустимое действие</span>
            </div>
        </div>


        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="reset" class="btn btn-danger">Очистить</button>
                <button type="submit" class="btn btn-success" name="add" >Отправить</button>
            </div>
        </div>
    </fieldset>
</form>
