<br>
<? if($errors != null):
foreach($errors as $e): ?>
    <p class="error"><?php echo $e; ?></p>
<?php endforeach;?>
<? endif;?>
<form class="form-horizontal" action="/adminPost/edit/<?php echo $fields['id_post'];?>" method="post"  enctype="multipart/form-data">
    <fieldset>
        <legend>Изменить пост</legend>

        <div class="form-group">
            <label for="inputTitle" class="col-lg-2 control-label">Заголовок</label>

            <div class="col-lg-10">
                <input type="text" class="form-control" id="inputTitle" name="title" value="<?php echo $fields['title']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Редактировать пост</label>
            <div class="col-lg-10">
                <textarea class="form-control" rows="3" id="textArea" name="text"><?php echo $fields['text']; ?></textarea>
                <span class="help-block">Измените текст</span>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label" for="file"> Изменить изображение</label>
            <div class="col-lg-10">
                <input id="filebutton" name="file" class="input-file btn-info btn-lg" type="file">
                <span class="help-block">Добавить файл с раширением <strong>.png /.jpg /.jpeg / .gif</strong></span>
                <img src=" <? echo $fields['file'] ?>" alt="">
            </div>
        </div>

        <div class="form-group">
            <label for="selectTag" class="col-lg-2 control-label">Выберите тег</label>
            <div class="col-lg-10">
                <select id="selectTag" multiple class="form-control" name="tags[]" size="5">
                    <? foreach ($tags as $tag): ?>
                        <option value="<?php echo $tag['id_tag'];?>"
                            <? if($fields['tags'] != null && in_array($tag['id_tag'], $fields['tags'])) echo
                            'selected="selected"'; ?>
                            >
                            <? echo 'ТЕГ: ' . $tag['name'] . '. Комментарий к тегу: ' . $tag['comment']; ?>
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