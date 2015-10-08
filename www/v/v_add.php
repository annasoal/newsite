<br>
<form class="form-horizontal" action="/admin/add" method="post">
    <fieldset>
        <legend>Добавить пост</legend>

        <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Новый пост</label>
            <div class="col-lg-10">
                <textarea class="form-control" rows="3" id="textArea" name="text"></textarea>
                <span class="help-block">Новое событие</span>
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
                <button type="submit" class="btn btn-success">Отправить</button>
            </div>
        </div>
    </fieldset>
</form>