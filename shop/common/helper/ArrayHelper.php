<?php

namespace app\common\helper;

/**
 * Class ArrayHelper
 * @package app\common\helper
 */
class ArrayHelper
{
    /**
     * @param string $key
     * @param array $data
     * @param null|mixed $default
     * @return mixed
     */
    public static function getValue(string $key, array $data, $default = null)
    {
        $parts = explode('.', $key);
        foreach ($parts as $part) {
            if (!array_key_exists($part, $data)) {
                return $default;
            }

            $data = $data[$part];
        }

        return $data;
    }
}
