<?php

function dispatch($url, $controllersPath, $baseUrl = null)
{
    if ($baseUrl) {
        $url = substr($url, strlen($baseUrl));
    }

    $parts = explode('/', trim($url, '/'));

    $controller = "{$controllersPath}/{$parts[0]}.php";
    if (!file_exists($controller)) {
        die("Controller '{$parts[0]}' is not defined");
    }

    require_once $controller;

    $action = 'action' . ucfirst($parts[1]);
    if (!function_exists($action)) {
        die("Action '{$parts[1]}' is not allowed in controller '{$parts[0]}'");
    }

    $action();
}
