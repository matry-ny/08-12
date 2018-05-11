<?php

namespace app\common\components\request;

use app\common\helper\ArrayHelper;
use app\common\helper\StringHelper;

/**
 * Class WebRequest
 * @package app\common\components\request
 */
class WebRequest extends Request
{
    protected function parse(): void
    {
        $request = $this->request;
        $request = StringHelper::stripAfter($request, '?');
        if ($this->urlPrefix) {
            $request = StringHelper::leftTrim($request, $this->urlPrefix);
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
        $reflectionController = new \ReflectionObject($this->controller);
        $reflectionAction = $reflectionController->getMethod($this->action);
        $reflectionArguments = $reflectionAction->getParameters();

        $result = [];
        foreach ($reflectionArguments as $argument) {
            /** @var \ReflectionParameter $argument */
            $default = $argument->isDefaultValueAvailable() ? $argument->getDefaultValue() : null;
            $result[] = ArrayHelper::getValue($argument->name, $params, $default);
        }

        return $result;
    }
}