<?php

namespace app\web\controllers;

use app\common\components\Controller;
use app\common\components\db\events\Delete;
use app\common\components\db\events\Insert;
use app\common\components\db\events\Select;
use app\common\components\db\events\Update;
use app\common\components\db\Query;

/**
 * Class TestController
 * @package app\web\controllers
 */
class TestController extends Controller
{
    public function actionInsert()
    {
        for ($i = 0; $i <= 10; $i++) {
            /** @var Insert $builder */
            $builder = (new Query())->getBuilder(Query::INSERT);
            $result = $builder
                ->insert(['title' => mt_rand(), 'author' => mt_rand() . '_Author'])
                ->into('test')
                ->execute();
        }

        return "Result: {$result}";
    }

    public function actionUpdate()
    {
        /** @var Update $builder */
        $builder = (new Query())->getBuilder(Query::UPDATE);
        $result = $builder
            ->update('test')
            ->set(['title' => 'Updated' . mt_rand()])
            ->where(['<=', 'id', 3])
            ->execute();

        return "Result: {$result}";
    }

    public function actionSelect()
    {
        /** @var Select $builder */
        $builder = (new Query())->getBuilder(Query::SELECT);
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
        /** @var Delete $builder */
        $builder = (new Query())->getBuilder(Query::DELETE);
        $result = $builder
            ->delete()
            ->from('test')
            ->where(['>', 'id', 6])
            ->execute();

        return "Result: {$result}";
    }

    public function actionBatchSelect()
    {
        /** @var Select $builder */
        $builder = (new Query())->getBuilder(Query::SELECT);
        $result = $builder->select(['*'])->from('test');

        foreach ($result->each() as $index => $row) {
            var_dump($index, $row);
        }

        return '';
    }
}