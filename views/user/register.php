<?php include ROOT . '/views/layouts/header.php'; ?>
    <div class="auth_form">
        <div class="form_caption">
            <div class="change_form">
                <a href="/user/login"><div>Вход</div></a>
            </div>
            <div class="form_title">Регистрация</div>
        </div>
        <div class="form_fields">
            <div class="form_field">
                <input id="firstname" class="input_field" type="text" placeholder="имя">
            </div>
            <div class="form_field">
                <input id="lastname" class="input_field" type="text" placeholder="фамилия">
            </div>
            <div class="form_field">
                <input id="login" class="input_field" type="text" placeholder="логин">
            </div>
            <div class="form_field">
                <input id="chat_id" class="input_field" type="text" placeholder="telegram id">
            </div>
            <div class="form_field">
                <input id="password" class="input_field" type="password" placeholder="пароль">
            </div>
        </div>
        <div class="form_submit" id="submit_register">
            <div>
                Подтвердить
            </div>
        </div>
    </div>
<?php include ROOT . '/views/layouts/footer.php'; ?>