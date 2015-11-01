<br>
 <? if($errors != null):
 foreach($errors as $e): ?>
    <p class="error"><?php echo $e; ?></p>
<?php endforeach;?>
<? endif;?>
<form class="form-horizontal" enctype="multipart/form-data"  method="post">
    <fieldset>
        <legend>Добавить пользователя</legend>
        <!--
        <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label">Email</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="inputEmail" placeholder="Email">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-lg-2 control-label">Password</label>
            <div class="col-lg-10">
                <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Checkbox
                    </label>
                </div>
            </div>
        </div>
        -->
        <div class="form-group">
            <label for="inputName" class="col-lg-2 control-label">Имя пользователя</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" required id="inputTitle" name="title" value="<?php echo
                $fields['name'];?>">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label">Email/login</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="inputEmail" required placeholder="Email" value="<?php echo
                $fields['email'];?>">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword" class="col-lg-2 control-label">Пароль пользователя</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" required id="inputTitle" name="password" placeholder="Пароль">
            </div>
        </div>
        <div class="form-group">
            <label for="inputBirthday" class="col-lg-2 control-label">Дата рождения пользователя</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="inputTitle" name="datebirth" value="<?php echo
                $fields['datebirth'];?>">
            </div>
        </div>

        <!-- File Button -->
        <div class="form-group">
            <label class="col-lg-2 control-label" for="file">Добавить аватар</label>
            <div class="col-lg-10">
                <input id="filebutton" name="file" class="input-file btn-info btn-lg" type="file">
                <span class="help-block">Добавить файл с раширением <strong>.png /.jpg /.jpeg / .gif</strong></span>
            </div>
        </div>

        <!--
        <div class="form-group">
            <label for="inputImgDescription" class="col-lg-2 control-label">Описание изображения</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="inputImgDescription" name="altdescription">
                <span class="help-block">Добавить <strong>альтернативное описание изображения</strong></span>
            </div>
        </div>
        <div class="form-group">
            <label for="inputImgFigcaption" class="col-lg-2 control-label">Подпись к изображению</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="inputImgDescription" name="figcaption">
                <span class="help-block">Добавить <strong>подпись к изображению</strong></span>
            </div>
        </div>
        -->

        <!--
        <div class="form-group">
            <label class="col-lg-2 control-label">Radios</label>
            <div class="col-lg-10">
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                        Option one is this
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                        Option two can be something else
                    </label>
                </div>
            </div>
        </div>
        -->
        <div class="form-group">
            <label for="selectTag" class="col-lg-2 control-label">Выберите роли</label>
            <div class="col-lg-10">
                <select id="selectTag" multiple  required class="form-control" name="roles[]" size="3">
                    <? foreach ($roles as $role): ?>
                        <option value="<?php echo $role['id_role'];?>"
                            <? if($fields['roles'] != null && in_array($role['id_role'], $fields['roles'])){
                            echo'selected="selected"'; }?>>
                            <? echo 'Роль: ' . $role['name']; ?>
                        </option>
                    <? endforeach;?>
                </select>
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