<?php include ROOT . '/views/layouts/header.php'; ?>
        <div class="welcome_window">
            <div>
                Вы зарегистрированы под логином <b><?php echo $_SESSION['login'];?></b>
            </div>
            <div><a href="/user/logout">Выйти</a></div>
        </div>
<?php include ROOT . '/views/layouts/footer.php'; ?>