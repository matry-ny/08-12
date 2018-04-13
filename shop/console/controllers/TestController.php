<?php

namespace app\console\controllers;

use app\common\components\cli\Controller;
use app\common\components\db\events\Select;
use app\common\components\db\Query;

/**
 * Class TestController
 * @package app\console\controllers
 */
class TestController extends Controller
{
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
