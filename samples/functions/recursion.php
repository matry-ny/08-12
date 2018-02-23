<?php

function power($number, $power)
{
    static $iterations;
    $iterations++;

    if ($power == 0) {
        return 1;
    } elseif ($power == 1) {
        return $number;
    } elseif ($power % 2 == 0) {
        $sub = power($number, $power / 2);
        return $sub * $sub;
    } else {
        return $number * power($number, $power - 1);
    }
}

var_dump(power(2, 16));

function fibonacci($level)
{
    if ($level < 0) {
        return null;
    } elseif ($level === 0) {
        return 0;
    } elseif ($level === 1 || $level === 2) {
        return 1;
    } else {
        return fibonacci($level - 1) + fibonacci($level - 2);
    }
}
var_dump(fibonacci(10));

function factorial($number)
{
    if ($number < 2) {
        return 1;
    } else {
        return ($number * factorial($number - 1));
    }
}
var_dump(factorial(5));