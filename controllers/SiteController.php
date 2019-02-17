<?php

class SiteController
{
    public function actionIndex()
    {

        $user_rows = User::getUsers();
        require_once(ROOT . '/views/site/index.php');

        return true;
    }
}
