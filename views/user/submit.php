<?php include ROOT . '/views/layouts/header.php'; ?>
    <div class="auth_form">
        <div class="form_caption">
            <div class="form_title_code">
                Подтвердить вход
            </div>
        </div>
        <div class="form_fields">
            <div class="form_field">
                <input id="telegram_code" class="input_field" type="text" placeholder="код из сообщения">
            </div>
        </div>
        <div class="form_submit" id="submit_code">
            <div>
                Подтвердить
            </div>
        </div>
    </div>
<?php include ROOT . '/views/layouts/footer.php'; ?>