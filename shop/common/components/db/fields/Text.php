<?php

namespace app\common\components\db\fields;

use app\common\components\db\FieldType;

/**
 * Class Text
 * @package common\components\db\fields
 */
class Text extends FieldType
{
    /**
     * @return string
     */
    public function build()
    {
        return "{$this->name} TEXT{$this->getDefault()}";
    }
}
