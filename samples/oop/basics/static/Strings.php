<?php

class Strings
{
    public static $string;

    public static function toUpperCase($string)
    {
        return mb_convert_case($string, MB_CASE_UPPER);
    }
}
