<?php

namespace app\api\controllers;

use app\common\components\Controller;
use app\web\models\User;

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
}
