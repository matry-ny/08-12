<?php

namespace app\common\components\db\fields;

use app\common\components\db\FieldType;

/**
 * Class Decimal
 * @package common\components\db\fields
 */
class Decimal extends FieldType
{
    /**
     * @return string
     */
    public function build()
    {
        return "{$this->name} DECIMAL({$this->length}){$this->getDefault()}";
    }
}
