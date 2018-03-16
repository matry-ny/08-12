<?php

namespace app\common\components\cli;

/**
 * Class Controller
 * @package app\common\components\cli
 */
class Controller extends \app\common\components\Controller
{
    /**
     * @param string $message
     * @return string
     */
    public function lineOut(string $message): string
    {
        return $message . PHP_EOL;
    }
}
