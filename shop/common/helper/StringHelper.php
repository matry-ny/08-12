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

    /**
     * @param string $string
     * @param string $substring
     * @return string
     */
    public static function stripAfter(string $string, string $substring): string
    {
        $substringPosition = stripos($string, $substring);
        if ($substringPosition) {
            $string = substr($string, 0, $substringPosition);
        }

        return $string;
    }

    /**
     * @param string $string
     * @param string $substring
     * @return string
     */
    public static function leftTrim(string $string, string $substring): string
    {
        if (stripos($string, $substring) === 0) {
            $string = substr($string, mb_strlen($substring));
        }

        return $string;
    }
}
