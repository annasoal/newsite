<br>
<br>
<? var_dump ($values);?>
<form class="form-horizontal"  method="post">
    <fieldset>
        <legend>Редактирование привилегии</legend>
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
                <span class="help-block">Соедержание</span>
            </div>
        </div>


        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="reset" class="btn btn-danger">Очистить</button>
                <button type="submit" class="btn btn-success" name="update">Отправить</button>
            </div>
        </div>
    </fieldset>
</form>
