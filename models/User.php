<?php

class User
{

    public static function register($firstname, $lastname, $login, $chatId, $password, $telegramCode)
    {

        $password = password_hash($password, PASSWORD_DEFAULT);
        $telegramCode = password_hash($telegramCode, PASSWORD_DEFAULT);
        $updatedAt = time();

        $db = Db::getConnection();

        $sql = 'INSERT INTO user (firstname, lastname, login, chat_id, password, telegram_code, updated_at) VALUES (:firstname, :lastname, :login, :chat_id ,:password, :telegram_code, :updated_at)';

        $result = $db->prepare($sql);
        $result->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $result->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':chat_id', $chatId, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':telegram_code', $telegramCode, PDO::PARAM_STR);
        $result->bindParam(':updated_at', $updatedAt, PDO::PARAM_STR);

        return $result->execute();

    }

    // устанавливает новый телеграм-код
    public static function updateCode($userId, $telegramCode)
    {
        $telegramCode = password_hash($telegramCode, PASSWORD_DEFAULT);

        $db = Db::getConnection();
        $sql = 'UPDATE user SET telegram_code = :telegram_code WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':telegram_code', $telegramCode, PDO::PARAM_STR);
        $result->bindParam(':id', $userId, PDO::PARAM_INT);

        return $result->execute();
    }

    // если проверочный код верный, возвращает user_id, иначе возвращает false
    public static function confirmCode($login, $telegramCode)
    {

        // получаем из бд запись с таким логином
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE login = :login LIMIT 1';

        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);

        $result->execute();

        $user = $result->fetch();

        // сравниваем телеграм-коды
        $isCodeValid = password_verify($telegramCode, $user['telegram_code']);

        // возвращаем результат
        if ($isCodeValid) {
            $output = $user['id'];
        } else {
            $output = false;
        }

        return $output;
    }

    /**
     * Проверяем, существует ли пользователь с заданными $email и $password
     * @param string $login
     * @param string $password
     * @return mixed : integer user id or false
     */
    public static function checkUserData($login, $password)
    {

        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE login = :login';

        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;

    }

    /**
     * Запоминаем пользователя
     * @param string $email
     * @param string $password
     */
    public static function auth($userId)
    {
        $_SESSION['user'] = $userId;
    }

    public static function checkLogged()
    {
        // Если сессия есть, вернет идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");
    }


    /**
     * Проверяет имя: не меньше, чем 2 символа
     */
    public static function checkFirstname($firstname)
    {
        if (!preg_match('/[^[:alpha]-]/', $firstname) && strlen($firstname) >= 1) {
            return true;
        }
        return false;
    }

    public static function checkLastname($lastname)
    {
        if (!preg_match('/[^[:alpha]-]/', $lastname) && strlen($lastname) >= 1) {
            return true;
        }
        return false;
    }

    public static function checkLogin($login)
    {
        $login = preg_replace('/[^[:alnum]_]/', '', $login);
        if (strlen($login) >= 4) {
            return true;
        }
        return false;
    }

    public static function checkChatId($chatId)
    {
        if (!preg_match('/[^[:digit:]]/', $chatId) && strlen($chatId) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет пароль: не меньше 6 символов
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }


    /**
     * Returns user by id
     * @param integer $id
     */
    public static function getUserById($id)
    {
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';

            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();

            return $result->fetch();

        }
    }
}
