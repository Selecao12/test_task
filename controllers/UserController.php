<?php

class UserController
{
    public function actionRegister()
    {
        $firstname = '';
        $lastname = '';
        $login = '';
        $chatId = '';
        $password = '';
        $telegramCode = '';

        $result = false;

        if (isset($_POST['submit'])) {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $login = $_POST['login'];
            $chatId = $_POST['chat_id'];
            $password = $_POST['password'];

            $errors = false;

            if (!User::checkFirstname($firstname)) {
                $errors[] = 'Неправильно заполнено поле имени';
            }

            if (!User::checkLastname($lastname)) {
                $errors[] = 'Неправильно заполнено поле фамилии';
            }

            if (!User::checkLogin($login)) {
                $errors[] = 'Неправильно заполнено поле логина';
            }

            if (!User::checkChatId($chatId)) {
                $errors[] = 'Неправильно заполнено поле с telegram id';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            if ($errors == false) {

                $telegramCode = random_int(100000, 999999);
                $result = User::register($firstname, $lastname, $login, $chatId, $password, $telegramCode);
            }

            if ($result) {

                // записываем в сессию логин пользователя для сравнения соответсвия телеграм-кода логину
                $_SESSION['login'] = $login;

                $output = [
                    'success' => true
                ];

                echo json_encode($output);
                flush();
                ob_flush();

                // отправляем телеграм-код через telegram API
                Telegram::sendCode($chatId, $telegramCode);

                return true;
            } else {
                return false;
            }
        }


        require_once(ROOT . '/views/user/register.php');

        return true;
    }

    public function actionLogin()
    {

        $login = '';
        $password = '';

        if (isset($_POST['submit'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            $errors = FALSE;

            // Валидация полей

            if (!User::checkLogin($login)) {
                $errors[] = 'Неправильный email';
            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
            }

            // Проверяем существует ли пользователь
            $user = User::checkUserData($login, $password);

            if ($user == FALSE) {
                $errors[] = 'Неправильные данные для входа на сайт';
            } else {
                $_SESSION['login'] = $login;

                $output = ['success' => true];

                echo json_encode($output);
                flush();
                ob_flush();

                $telegramCode = random_int(100000, 999999);

                User::updateCode($user['id'], $telegramCode);

                Telegram::sendCode($user['chat_id'], $telegramCode);

                return true;
            }
        }

        require_once(ROOT . '/views/user/login.php');

        return true;
    }

    public function actionSubmit()
    {
        if (!isset($_SESSION['login']) || isset($_SESSION['user'])) {
            header('Location: /');
        }
        if (isset($_POST['submit'])) {

            // получаем введенный пользователем код
            $telegram_code = $_POST['telegram_code'];

            // получаем из сессии логин пользователя
            $login = $_SESSION['login'];

            // проверяем валидность кода и получаем user_id
            $userID = User::confirmCode($login, $telegram_code);

            // если код неверный, возвращаем false
            if ($userID == false) {
                return false;
            }

            // если код правильный, возвращаем true и пишем в сессию userId
            User::auth($userID);

            $output = ['success' => true];

            echo json_encode($output);

            return true;
        }

        require_once(ROOT . '/views/user/submit.php');

        return true;
    }

    public function actionLogout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['login']);
        header("Location: /user/login");
    }
}
