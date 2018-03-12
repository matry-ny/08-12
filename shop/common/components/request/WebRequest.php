<?php

namespace app\common\components\request;

use app\common\Application;
use app\common\components\Controller;
use app\common\helper\StringHelper;

/**
 * Class WebRequest
 * @package app\common\components\request
 */
class WebRequest extends Request
{
    protected function parse(): void
    {
        $parts = explode('/', trim($this->request, " \t\n\r\0\x0B/"));

        $controllerPart = array_shift($parts);
        $this->controller = $this->prepareController($controllerPart);

        $actionPart = array_shift($parts);
        $this->action = $this->prepareAction($actionPart);
    }

    /**
     * @param string $part
     * @return Controller
     * @throws \Exception
     */
    private function prepareController(string $part): Controller
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
    private function prepareAction(string $part): string
    {
        $part = $part ?: Application::get()->param('actions.default');
        $action = 'action' . StringHelper::camelize($part);

        if (!method_exists($this->controller, $action)) {
            throw new \Exception("Action '{$part}' is not exists");
        }

        return $action;
    }
}