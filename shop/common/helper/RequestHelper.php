<?php

namespace app\common\helper;

/**
 * Class RequestHelper
 * @package app\common\helper
 */
class RequestHelper
{
    /**
     * @param string $key
     * @return mixed
     */
    public static function getHttpHeader(string $key)
    {
        $key = 'HTTP_' . strtoupper(str_replace('-', '_', $key));
        return ArrayHelper::getValue($key, $_SERVER);
    }

    /**
     * @return string
     */
    public static function getAddress(): string
    {
        return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    }

    /**
     * @return array
     */
    public static function getData(): array
    {
        return $_REQUEST;
    }
}
