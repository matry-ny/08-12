<?php

error_reporting(E_ALL);

function isAdult($age, $country, $gender = 'male')
{
    $counties = [
        'Ukraine' => 18,
        'USA' => 21,
        'China' => 16
    ];

    if (array_key_exists($country, $counties)) {
        $coefficient = $gender == 'female' ? 0.99 : 1;
        return $counties[$country] <= $age * $coefficient;
    }

    return true;
}

var_dump(isAdult(16, 'USA', 'female'), isAdult(18, 'China'));

$number = 2;
function power(&$int, $power)
{
    $int = pow($int, $power);
    return true;
}
if (power($number, 3)) {
    var_dump($number);
}

$array = [3, 4, 5];
foreach ($array as &$value) {
    $value += 1;
}
var_dump($array);

echo '<hr>';

function parseValues($string, array $array) {
    $results = 0;
    foreach ($array as $value) {
        if (stripos($string, $value)) {
            $results++;
        }
    }

    return $results;
}
$values = parseValues('test string 4 parsing', ['string']);
var_dump($values);