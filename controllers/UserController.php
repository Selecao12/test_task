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

            echo json_encode(['result' => 'error']);
            return false;
        }

        // Успешное добавление в БД
        $lastInsertedId = User::addUser($lastname, $firstname, $patronymic);
        if (!$lastInsertedId) {
            echo json_encode(['result' => 'error']);
            return false;
        }

        echo json_encode([
            'result' => 'ok',
            'id' => $lastInsertedId,
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
                'result' => 'error'
            ]);

            return false;
        }

        echo json_encode([
            'result' => 'ok',
            'id' => $id
        ]);

        return true;
    }
}