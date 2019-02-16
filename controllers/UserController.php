<?php

class UserController
{

    // добавляет пользователя
    public function actionAddUser()
    {

        $lastname = trim($_POST['lastname']);
        $firstname = trim($_POST['firstname']);
        $patronymic = trim($_POST['patronymic']);

        // Присутствуют недопустимые символы
        if (!User::checkUserName($lastname, $firstname, $patronymic)) {

            echo json_encode(['result' => 'false']);
            return false;
        }

        echo json_encode([
            'lastname' => $lastname,
            'firstname' => $firstname,
            'patronymic' => $patronymic
        ]);

        return true;
    }

    // удаляет пользователя
    public function actionDeleteUser()
    {
        $id = $_POST['id'];

        $result = User::deleteUser($id);

        if (!$result) {
            echo json_encode([
                'result' => 'false'
            ]);

            return false;
        }

        echo json_encode([
            'id' => $id
        ]);

        return true;
    }

    // fixme Удалить?
    // возвращает пользователей
    public function actionGetUsers()
    {
        $users = User::getUsers();
        echo json_encode($users);

        return true;
    }
}
