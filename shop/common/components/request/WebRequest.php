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
        $request = $this->request;
        if (stripos($request, '?')) {
            $request = substr($request, 0, stripos($request, '?'));
        }
        $parts = explode('/', trim($request, " \t\n\r\0\x0B/"));

        $controllerPart = array_shift($parts);
        $this->controller = $this->prepareController($controllerPart);

        $actionPart = array_shift($parts);
        $this->action = $this->prepareAction($actionPart);

        $this->params = $this->prepareParams($_GET);
    }

    /**
     * @param mixed $params
     * @return array
     */
    protected function prepareParams($params): array
    {
        return $params;
    }
}