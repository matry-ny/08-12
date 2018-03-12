<?php

namespace app\common;

use Exception;
use app\common\components\request\Parser;
use app\common\helper\ArrayHelper;

/**
 * Class Application
 * @package app\common
 */
class Application
{
    private function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @var null|Application
     */
    private static $app = null;

    /**
     * @var array
     */
    private $config;

    /**
     * @param array $config
     * @return Application
     * @throws Exception
     */
    public static function init(array $config): Application
    {
        if (null !== self::$app) {
            throw new Exception('Application is already created');
        }

        self::$app = new self();
        self::$app->config = $config;
        self::$app->run();

        return self::$app;
    }

    /**
     * @return Application
     * @throws Exception
     */
    public static function get(): Application
    {
        if (null === self::$app) {
            throw new Exception('Application is not created yet');
        }

        return self::$app;
    }

    private function run()
    {
        $request = (new Parser())->getRequest();

        $controller = $request->getController();
        $action = $request->getAction();
        $params = $request->getParams();

        return call_user_func([$controller, $action], $params);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function param(string $key)
    {
        return ArrayHelper::getValue($key, $this->config);
    }
}
