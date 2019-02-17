<?php include ROOT . '/views/layouts/header.php'; ?>
    <div class="wrapper">
        <div class="form">
            <div class="form_caption">
                <div>Добавить пользователя</div>
            </div>
            <div class="form_field">
                <input type="text" placeholder="Фамилия" id="id_form_lastname">
            </div>
            <div class="form_field">
                <input type="text" placeholder="Имя" id="id_form_firstname">
            </div>
            <div class="form_field">
                <input type="text" placeholder="Отчество" id="id_form_patronymic">
            </div>
            <div class="form_field" id="id_form_add_button" onclick="addUser()">
                <div>
                    <i class="fa fa-plus" style="color: green"></i>
                </div>
            </div>
        </div>
        <div class="table">
            <div class="table_caption">
                <div class="table_ceil table_ceil_id">
                    <div>id</div>
                </div>
                <div class="table_ceil table_ceil_lastname">
                    <div>
                        Фамилия
                    </div>
                </div>
                <div class="table_ceil table_ceil_firstname">
                    <div>
                        Имя
                    </div>
                </div>
                <div class="table_ceil table_ceil_patronymic">
                    <div>
                        Отчество
                    </div>
                </div>
                <div class="table_ceil table_ceil_delete_button">
                    Удалить
                </div>
            </div>
            <div class="table_content">
                <?php foreach ($user_rows as $row): ?>
                    <div class="table_row" id="<?=$row['id'] ?>">
                        <div class="table_ceil table_ceil_id">
                            <div>
                                <?=$row['id'] ?>
                            </div>
                        </div>
                        <div class="table_ceil table_ceil_lastname">
                            <div>
                                <?=$row['lastname'] ?>
                            </div>
                        </div>
                        <div class="table_ceil table_ceil_firstname">
                            <div>
                                <?=$row['firstname'] ?>
                            </div>
                        </div>
                        <div class="table_ceil table_ceil_patronymic">
                            <div>
                                <?=$row['patronymic'] ?>
                            </div>
                        </div>
                        <div class="table_ceil table_ceil_delete_button" onclick="deleteUser(<?=$row['id'] ?>)">
                            <i class="fa fa-minus" style="color: red"></i>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php include ROOT . '/views/layouts/footer.php'; ?>