<?php

namespace app\common\components\db\conditions;

use app\common\components\db\Condition;

/**
 * Class Equals
 * @package db\conditions
 */
class Equals extends Condition
{
    /**
     * @return string
     */
    public function getConditionString()
    {
        return "{$this->field} {$this->marker} '{$this->value}'";
    }
}