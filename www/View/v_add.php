<br>

<form class="form-horizontal" enctype="multipart/form-data" action="/adminPost/add/" method="post">
    <fieldset>
        <legend>Добавить пост</legend>
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
            <label for="inputTitle" class="col-lg-2 control-label">Заголовок</label>

            <div class="col-lg-10">
                <input type="text" class="form-control" id="inputTitle" name="title" value="<?php echo $fields['title'];?>">
            </div>
        </div>
        <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Новый пост</label>

            <div class="col-lg-10">
                <textarea class="form-control" rows="5" id="textArea" name="text"><?php echo $fields['text'];?></textarea>
                <span class="help-block">Новое событие</span>
            </div>
        </div>

        <!-- File Button -->
        <div class="form-group">
            <label class="col-lg-2 control-label" for="file">Добавить изображение</label>

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
        <!--<div class="form-group">
            <label for="tag-selection" class="col-lg-2 control-label" >Выберите тег</label>
            <div class="col-lg-10">

                <select id="tag-selection" multiple required class="form-control" name="tags[]" size="10">
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
                <button type="reset" class="btn btn-danger">Очистить</button>
                <button type="submit" class="btn btn-success">Отправить</button>
            </div>
        </div>
    </fieldset>
</form>