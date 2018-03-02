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

var_dump(new test_qwerty_Monkey());

$water = new Water('Artesian (1000 meters)');
$hmel = new Hmel('Ukrainian');
$solod = new Solod('Yachmen');

var_dump((new Bar())->makeDarkBeer($water, $solod, $hmel));
