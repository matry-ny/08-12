<?php

namespace app\common\components\request;

use app\common\components\enums\CliSapiNames;

/**
 * Class Parser
 * @package app\common\components\request
 */
class Parser
{
    /**
     * @return Request
     * @throws \Exception
     * @throws \ReflectionException
     */
    public function getRequest(): Request
    {
        $cliSapis = (new CliSapiNames())->getConstList();
        $isCli = in_array(strtolower(php_sapi_name()), array_values($cliSapis));
        if ($isCli) {
            global $argv;
            $request = new CliRequest($argv);
        } else {
            $request = new WebRequest($_SERVER['REQUEST_URI']);
        }

        return $request;
    }
}
