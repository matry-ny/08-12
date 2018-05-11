<?php

namespace app\common\components\request;

use app\common\Application;
use app\common\components\Controller;
use app\common\helper\StringHelper;

/**
 * Class Request
 * @package app\common\components\request
 */
abstract class Request
{
    /**
     * @var string|array
     */
    protected $request;

    /**
     * @var Controller
     */
    protected $controller;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var null|string
     */
    protected $urlPrefix = null;

    /**
     * Request constructor.
     * @param string|array $request
     * @param string $urlPrefix
     */
    public function __construct($request, string $urlPrefix = null)
    {
        $this->request = $request;
        $this->urlPrefix = $urlPrefix;
        $this->parse();
    }

    protected abstract function parse(): void;

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * @param string $part
     * @return Controller
     * @throws \Exception
     */
    protected function prepareController(string $part): Controller
    {
        $part = $part ?: Application::get()->param('controllers.default');
        $class = vsprintf('%s\%sController', [
            Application::get()->param('controllers.namespace'),
            StringHelper::camelize($part)
        ]);

        if (!class_exists($class)) {
            throw new \Exception("Controller '{$part}' is not exists");
        }

        $controllerObject = new $class();
        if (!$controllerObject instanceof Controller) {
            throw new \Exception("Controller '{$part}' is invalid");
        }

        return $controllerObject;
    }

    /**
     * @param string $part
     * @return string
     * @throws \Exception
     */
    protected function prepareAction(string $part): string
    {
        $part = $part ?: Application::get()->param('actions.default');
        $action = 'action' . StringHelper::camelize($part);

        if (!method_exists($this->controller, $action)) {
            throw new \Exception("Action '{$part}' is not exists");
        }

        return $action;
    }

    /**
     * @param mixed $params
     * @return array
     */
    protected abstract function prepareParams($params): array;
}
