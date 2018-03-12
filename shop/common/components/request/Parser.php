<?php

namespace app\common\components\request;

/**
 * Class Parser
 * @package app\common\components\request
 */
class Parser
{
    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        $isCli = strtolower(php_sapi_name()) === 'cli';
        if ($isCli) {
            global $argv;
            $request = new CliRequest($argv);
        } else {
            $request = new WebRequest($_SERVER['REQUEST_URI']);
        }

        return $request;
    }
}
