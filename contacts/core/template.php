<?php

function render($template, array $variables = [])
{
    $viewsPath = config('viewsPath');

    extract($variables);

    ob_start();
    require_once "{$viewsPath}/{$template}.php";
    $content = ob_get_clean();

    ob_start();
    require_once "{$viewsPath}/layouts/main.php";
    return ob_get_clean();
}
