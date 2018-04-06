<?php

namespace app\common\components\db\conditions;

use app\common\components\db\Condition;

/**
 * Class Like
 * @package db\conditions
 */
class Like extends Condition
{
    /**
     * @return string
     */
    public function getConditionString()
    {
        return "{$this->field} {$this->marker} '{$this->value}'";
    }
}