<?php

namespace app\web\controllers;

use app\common\components\Controller;
use app\web\models\User;

/**
 * Class UsersController
 * @package app\web\controllers
 */
class UsersController extends Controller
{
    public function actionList()
    {
        $users = User::findAll();
        foreach ($users as $user) {
            /** @var User $user */
            $user->load(['name' => "{$user->name} Updated"]);
            $user->save();
        }

        $user = new User();
        $user->load(['name' => 'User ' . mt_rand()]);
        $user->save();

        $users = User::findAll();
        var_dump($users);
        exit;
    }

    public function actionDelete($id)
    {
        $user = User::findOne($id);

        if ($user) {
            var_dump($user);
            $user->clear();
            var_dump($user);
            $user->load(['name' => 'Reverted User']);
            $user->save();
            var_dump($user);
        }

        return 'Done';
    }
}
