<?php

namespace app\api\controllers;

use app\web\models\User;
use app\api\components\Controller;

/**
 * Class UsersController
 * @package app\api\controllers
 */
class UsersController extends Controller
{
    /**
     * @return string
     */
    public function actionGetList(): string
    {
        $users = User::findAll([], true);
        return json_encode($users);
    }

    /**
     * @return string
     */
    public function actionCreate(): string
    {
        $user = new User();
        $user->load($_POST);

        return $user->save() ? 'OK' : 'FAIL';
    }
}
