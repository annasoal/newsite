<br>
<br>
<? var_dump($values); ?>
<form class="form-horizontal" method="post">
    <fieldset>
        <legend>Редактирование тега</legend>
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
                <button type="submit" class="btn btn-success" name="update">Отправить</button>
            </div>
        </div>
    </fieldset>
</form>
