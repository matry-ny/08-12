<?php

namespace app\common\helper;

/**
 * Class StringHelper
 * @package app\common\helper
 */
class StringHelper
{
    /**
     * @param string $string
     * @param bool $ucFirst
     * @param string $symbol
     * @return string
     */
    public static function camelize(string $string, bool $ucFirst = true, string $symbol = '-'): string
    {
        $parts = explode($symbol, $string);
        $result = $ucFirst ? '' : strtolower(array_shift($parts));
        foreach ($parts as $part) {
            $result .= ucfirst(strtolower($part));
        }

        return $result;
    }
}
