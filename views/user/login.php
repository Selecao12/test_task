<?php include ROOT . '/views/layouts/header.php'; ?>
    <div class="auth_form">
        <div class="form_caption">
            <div class="form_title">
                Вход
            </div>
            <div class="change_form">
                <a href="/user/register">Регистрация</a>
            </div>
        </div>
        <div class="form_fields">
            <div class="form_field">
                <input id="login" class="input_field" type="text" placeholder="логин">
            </div>
            <div class="form_field">
                <input id="password" class="input_field" type="password" placeholder="пароль">
            </div>
        </div>
        <div class="form_submit" id="submit_login">
            <div>
                Подтвердить
            </div>
        </div>
    </div>
<?php include ROOT . '/views/layouts/footer.php'; ?>