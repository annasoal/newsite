<br>

 <? if($errors != null):
 foreach($errors as $e): ?>
    <p class="error"><?php echo $e; ?></p>
<?php endforeach;?>
<? endif;?>
<form class="form-horizontal" enctype="multipart/form-data"  method="post">
    <fieldset>
        <legend>Добавить роль</legend>
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
            <label for="inputName" class="col-lg-2 control-label">Название роли</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" required id="inputName" name="role" value="<?php echo
                $fields['name'];?>">
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
            <label for="selectTag" class="col-lg-2 control-label">Выберите привилегии</label>
            <div class="col-lg-10">
                <select id="selectTag" multiple  required class="form-control" name="privs[]" size="3">
                    <? foreach ($privs as $priv): ?>
                        <option value="<?php echo $priv['id_priv'];?>"
                            <? if($fields['privs'] != null && in_array($priv['id_priv'], $fields['privs'])){
                            echo'selected="selected"'; }?>>
                            <? echo 'Привилегия: ' . $priv['name']; ?>
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