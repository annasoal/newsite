<form class="form-horizontal" method="post">
    <fieldset>
        <legend>Авторизация пользователя</legend>
        <div class="form-group">
            <label for="inputEmail" class="col-lg-2 control-label">Email/login</label>

            <div class="col-lg-10">
                <input type="email" class="form-control" id="inputEmail" required placeholder="Email"
                       name='email' value="<?php echo $fields['email']; ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="inputPassword" class="col-lg-2 control-label">Пароль</label>

            <div class="col-lg-10">
                <input type="password" class="form-control" required id="inputPassword" name="password"
                       placeholder="Пароль">

                <div class="checkbox">
                    <label for="inputRemember">
                        <input type="checkbox" name="remember" id="inputRemember"> Запомнить меня
                    </label>
                </div>
            </div>
        </div>


        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="reset" class="btn btn-danger">Очистить</button>
                <button type="submit" class="btn btn-success" name="login">Отправить</button>
            </div>
        </div>
    </fieldset>
</form>