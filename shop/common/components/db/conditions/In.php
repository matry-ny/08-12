<?php

namespace app\common\components\db\conditions;

use app\common\components\db\Condition;

class In extends Condition
{
    /**
     * @return string
     */
    public function getConditionString()
    {
        $options = "'" . implode("', '", $this->value) . "'";
        return "{$this->field} {$this->marker} ({$options})";
    }
}