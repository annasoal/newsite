<br>
<? if ($errors != null):
    foreach ($errors as $e): ?>
        <p class="error"><?php echo $e; ?></p>
    <?php endforeach;?>
<? endif; ?>
<form class="form-horizontal" method="post">
    <fieldset>
        <legend>Изменить роль</legend>

        <div class="form-group">
            <label for="inputName" class="col-lg-2 control-label">Название роли</label>

            <div class="col-lg-10">
                <input type="text" class="form-control" required id="inputName" name="role" value="<?php echo
                $fields['role']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Описание роли</label>

            <div class="col-lg-10">
                <textarea class="form-control" rows="5" id="textArea" name="description"><?php echo
                    $fields['description'];
                    ?></textarea>
                <span class="help-block">Комментарий к роли</span>
            </div>
        </div>


        <div class="form-group">
            <label for="selectTag" class="col-lg-2 control-label">Выберите привилегии</label>

            <div class="col-lg-10">
                <select id="selectTag" multiple required class="form-control" name="privs[]" size="3">
                    <? foreach ($privs as $priv): ?>
                        <option value="<?php echo $priv['id_priv']; ?>"
                            <? if ($fields['privs'] != null && in_array($priv['id_priv'], $fields['privs'])) {
                                echo 'selected="selected"';
                            } ?>>
                            <? echo 'Привилегия: ' . $priv['name']; ?>
                        </option>
                    <? endforeach; ?>
                </select>
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