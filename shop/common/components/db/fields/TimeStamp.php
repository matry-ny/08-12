<?php

namespace app\common\components\db\fields;

use app\common\components\db\FieldType;

/**
 * Class TimeStamp
 * @package common\components\db\fields
 */
class TimeStamp extends FieldType
{
    /**
     * @return string
     */
    public function build()
    {
        $field = "{$this->name} TIMESTAMP{$this->getDefault()}";
        return $field;
    }
}
