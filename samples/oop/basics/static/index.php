<?php

require_once __DIR__ . '/Strings.php';

Strings::$string = 'Test string';

var_dump(Strings::toUpperCase('Test string'));

require_once __DIR__ . '/GrandFather.php';
require_once __DIR__ . '/Father.php';
require_once __DIR__ . '/Son.php';

$object = new Father();
var_dump($object->className());

var_dump(Strings::NUMBER_THREE, Strings::getNumberThree());
