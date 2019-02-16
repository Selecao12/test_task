<?php

class User
{

    // добавляет пользователя
    public static function addUser($lastname, $firstname, $patronymic)
    {
        $db = Db::getConnection();

        $sql = "INSERT INTO user (lastname, firstname, patronymic) VALUES(:lastname, :firstname, :patronymic)";

        $result = $db->prepare($sql);
        $result->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $result->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $result->bindParam(':patronymic', $patronymic, PDO::PARAM_STR);

        return $result->execute();
    }

    // удаляет пользователя
    public static function deleteUser($id)
    {
        $db = Db::getConnection();

        $sql = "DELETE FROM user WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    // возвращает пользователей
    public static function getUsers()
    {
        $db = Db::getConnection();

        $sql = "SELECT FROM user ORDER BY id DESC";
        $result = $db->query($sql);

        $users = $result->fetchAll(PDO::FETCH_ASSOC);

        return $users;
    }

    public static function checkUserName($lastname, $firstname, $patronymic)
    {
        $result = true;

        if (preg_match('/[^[:alpha:]-]/u', $lastname) || preg_match('/[^[:alpha:]-]/u', $firstname) ||
            preg_match('/[^[:alpha:]-]/u', $patronymic)) {

            $result = false;
        }

        return $result;
    }
}
