<?php

function render($template, array $variables = [])
{
    $viewsPath = config('viewsPath');

    extract($variables);
    require_once "{$viewsPath}/{$template}.php";
}
