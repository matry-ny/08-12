<?php

namespace app\common\components\db;

/**
 * Class Expression
 * @package common\components\db
 */
class Expression
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * Expression constructor.
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}