<?php

namespace app\web\controllers;

use app\common\Application;
use app\common\components\Controller;

/**
 * Class TestController
 * @package app\web\controllers
 */
class TestController extends Controller
{
    public function actionQwerty()
    {
//        $result = Application::get()
//            ->getDb()
//            ->insert('test', [
//                'title' => 'Some string 2',
//                'author' => 'Dmytro Kotenko 2'
//            ])->execute();

        $result = Application::get()
            ->getDb()
            ->update(
                'test',
                ['title' => 'Updated w', 'author' => 'Other Man 2']
            )
            ->where('')
            ->andWhere('')
            ->orWhere('')
            ->execute();

        var_dump($result);

        exit;
    }
}