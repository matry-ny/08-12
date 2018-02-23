<?php

$int = 123;
$int = strval($int);
$int = floatval($int);
$int = (string)$int;
$int = (array)$int;

$arr = [1, 2];
$int = (int)$arr;

var_dump($int);
