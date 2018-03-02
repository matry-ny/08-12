<?php

class Strings
{
    const NUMBER_THREE = 3;

    public static $string;

    public static function toUpperCase($string)
    {
        return mb_convert_case($string, MB_CASE_UPPER);
    }

    public static function getNumberThree()
    {
        return self::NUMBER_THREE;
    }
}
