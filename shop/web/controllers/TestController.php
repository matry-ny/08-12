<?php

namespace app\web\controllers;

use app\common\Application;
use app\common\components\Controller;
use app\common\components\enums\CliSapiNames;
use dk\database\Query;

/**
 * Class TestController
 * @package app\web\controllers
 */
class TestController extends Controller
{
    public function actionInsert()
    {
        for ($i = 0; $i <= 10; $i++) {
            /** @var \dk\database\events\Insert $builder */
            $builder = (new Query())->getBuilder(Query::INSERT, Application::getDb()->getConnection());
            $result = $builder
                ->insert(['title' => mt_rand(), 'author' => mt_rand() . '_Author'])
                ->into('test')
                ->execute();
        }

        return "Result: {$result}";
    }

    public function actionUpdate()
    {
        /** @var \dk\database\events\Update $builder */
        $builder = (new Query())->getBuilder(Query::UPDATE, Application::getDb()->getConnection());
        $result = $builder
            ->update('test')
            ->set(['title' => 'Updated' . mt_rand()])
            ->where(['<=', 'id', 3])
            ->execute();

        return "Result: {$result}";
    }

    public function actionSelect()
    {
        /** @var \dk\database\events\Select $builder */
        $builder = (new Query())->getBuilder(Query::SELECT, Application::getDb()->getConnection());
        $result = $builder
            ->select(['*'])
            ->from('test')
            ->where(['<', 'id', 5])
            ->andWhere(['>', 'id', 2])
            ->all();

        var_dump($result);exit;
    }

    public function actionDelete()
    {
        /** @var \dk\database\events\Delete $builder */
        $builder = (new Query())->getBuilder(Query::DELETE, Application::getDb()->getConnection());
        $result = $builder
            ->delete()
            ->from('test')
            ->where(['>', 'id', 6])
            ->execute();

        return "Result: {$result}";
    }

    public function actionBatchSelect()
    {
        /** @var \dk\database\events\Select $builder */
        $builder = (new Query())->getBuilder(Query::SELECT, Application::getDb()->getConnection());
        $result = $builder->select(['*'])->from('test');

        foreach ($result->each() as $index => $row) {
            var_dump($index, $row);
        }

        return '';
    }

    public function actionParams($id, $title, $nonRequired = 123)
    {
        var_dump($id, $title, $nonRequired);

        $cli = new CliSapiNames(CliSapiNames::CGI);
        var_dump($cli->getConstList());

        return $cli;
    }
}