<?php

class Registry
{
    /**
     * @var array
     */
    private static $storage = [];

    /**
     * @param string $key
     * @param mixed $value
     */
    public static function set(string $key, $value)
    {
        self::$storage[$key] = $value;
    }

    /**
     * @param string $key
     * @param null|mixed $default
     * @return mixed|null
     */
    public static function get(string $key, $default = null)
    {
        return array_key_exists($key, self::$storage) ? self::$storage[$key] : $default;
    }
}
