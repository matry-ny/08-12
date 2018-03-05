<?php

function __autoload($class)
{
    $class = str_replace('_', DIRECTORY_SEPARATOR, $class);
    $file = __DIR__ . "/{$class}.php";
    if (!file_exists($file)) {
        die("Class {$class} is not exists");
    }

    require_once $file;
}
