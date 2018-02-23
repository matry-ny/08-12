<?php

error_reporting(E_ALL);

$test = 1;

function doSomething(&$var)
{
//    $var += 2;
//    unset($var);

    global $test;
    $test += 1;
    unset($test);

//    $GLOBALS['test'] += 3;
//    unset($GLOBALS['test']);
}
doSomething($test);

var_dump($test);

$test2 = 2;

$test3 = (function () use ($test2) {
    $test2 += 2;
    return $test2;
})();

var_dump($test2, $test3);
