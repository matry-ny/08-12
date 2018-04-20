<?php

namespace app\common\components;

use Exception;
use ReflectionClass;

/**
 * Class Enum
 * @package app\common\components
 */
abstract class Enum
{
    const __DEFAULT = null;

    /**
     * @var mixed
     */
    private $value;

    /**
     * Enum constructor.
     * @param null $value
     * @throws Exception
     * @throws \ReflectionException
     */
    final public function __construct($value = null)
    {
        $class = new ReflectionClass($this);
        if ($value && !in_array($value, $class->getConstants())) {
            throw new Exception();
        }

        $this->value = $value;
    }

    /**
     * @param bool $includeDefault
     * @return array
     * @throws \ReflectionException
     */
    final public function getConstList(bool $includeDefault = false) : array
    {
        $class = new ReflectionClass($this);
        $constants = $class->getConstants();

        if (false === $includeDefault) {
            unset($constants['__DEFAULT']);
        }

        return $constants;
    }

    /**
     * @return mixed
     */
    final public function __toString() : string
    {
        return strval($this->value ?: static::__DEFAULT);
    }
}
