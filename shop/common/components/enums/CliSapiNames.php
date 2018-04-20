<?php

namespace app\common\components\enums;

use app\common\components\Enum;

/**
 * Class CliSapiNames
 * @package app\common\components\enums
 */
class CliSapiNames extends Enum
{
    const __DEFAULT = self::CLI;

    const CLI = 'cli';
    const CGI = 'cgi';
    const FCGI = 'cgi-fcgi';
}
