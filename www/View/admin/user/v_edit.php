<br>
<? var_dump($fields);if($errors != null):
foreach($errors as $e): ?>
    <p class="error"><?php echo $e; ?></p>
<?php endforeach;?>
<? endif;?>
<form class="form-horizontal"  method="post" enctype="multipart/form-data">
    <fieldset>
        <legend>Изменить пользователя</legend>

        <div class="form-group">
            <label for="inputName" class="col-lg-2 control-label">Имя пользователя</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" required id="inputName" name="name" value="<?php echo
                $fields['name'];?>">
            </div>
        </div>

        <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label">Email/login</label>
            <div class="col-lg-10">
                <input type="email" class="form-control" id="inputEmail" required placeholder="Email"
                       name='email' value="<?php echo $fields['email'];?>">
            </div>
        </div>

        <div class="form-group">
            <label for="inputPassword" class="col-lg-2 control-label">Пароль пользователя</label>
            <div class="col-lg-10">
                <input type="password" class="form-control" required id="inputTitle" name="password"
                       placeholder="Пароль">
            </div>
        </div>
        <div class="form-group">
            <label for="inputBirthday" class="col-lg-2 control-label">Дата рождения пользователя</label>
            <div class="col-lg-10">
                <input type="date" class="form-control" id="inputBirthday" name="datebirth" value="<?php echo
                $fields['datebirth'];?>">
            </div>
        </div>

        <div class="form-group">
            <label for="selectTag" class="col-lg-2 control-label">Выберите тег</label>
            <div class="col-lg-10">
                <select id="selectTag" required multiple class="form-control" name="roles[]" size="3">
                    <? foreach ($roles as $role): ?>
                        <option value="<?php echo $role['id_role'];?>"
                            <? if($fields['roles'] != null && in_array($role['id_role'], $fields['roles'])) echo
                            'selected="selected"'; ?>
                            >
                            <? echo 'РОЛЬ: ' . $role['name']; ?>
                        </option>
                    <? endforeach;?>
                </select>
            </div>
        </div>
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
        <div class="form-group">
            <label for="select" class="col-lg-2 control-label">Selects</label>
            <div class="col-lg-10">
                <select class="form-control" id="select">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
                <br>
                <select multiple="" class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
        </div>
        -->
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="reset" class="btn btn-warning">Очистить</button>
                <button type="submit" class="btn btn-success" name="update">Отправить</button>
            </div>
        </div>
    </fieldset>
</form>