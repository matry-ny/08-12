<?php

error_reporting(E_ALL);

require_once __DIR__ . '/Magic.php';

$magic = new Magic();
$magic->test = 1232222;
$magic->Property1 = 1;
$magic->property2 = 2;

var_dump(
    $magic,
    $magic->property2,
    $magic->getproperty2(),
    isset($magic->property2)
);

$serialized = serialize($magic);
var_dump($serialized);
$unserialized = unserialize($serialized);
var_dump($unserialized);

var_dump($magic());

echo $magic . ' >> is awesome';
