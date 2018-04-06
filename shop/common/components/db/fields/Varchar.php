<?php

namespace app\common\components\db\fields;

use app\common\components\db\FieldType;

/**
 * Class Varchar
 * @package common\components\db\fields
 */
class Varchar extends FieldType
{
    /**
     * @return string
     */
    public function build()
    {
        return "{$this->name} VARCHAR({$this->length}){$this->getNotNull()}{$this->getDefault()}";
    }
}
