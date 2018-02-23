<?php

$test = 1;
$qwerty = &$test;

$qwerty = 2;

var_dump($test, $qwerty);
