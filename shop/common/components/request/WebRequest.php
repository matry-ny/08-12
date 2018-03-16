<?php

namespace app\common\components\request;

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
     * @param mixed $params
     * @return array
     */
    protected function prepareParams($params): array
    {
        return [];
    }
}