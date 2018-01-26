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

echo '<hr>';

function oldSummary()
{
    return array_sum(func_get_args());
}
$summary = oldSummary(1, 3, 5, 6);
var_dump($summary);

function newSummary($var, $some, ...$data)
{
    var_dump($var, $some);
    return array_sum($data);
}
$summary2 = newSummary('test', 'qwerty', 1, 4, 6, 8, 1);
var_dump($summary2);

echo '<hr>';

function toArray(...$data)
{
    return $data;
}
var_dump(toArray(1, 3, 4)[1]);
list($var1, $var2, $var3) = toArray(4, 5, 6, 4, 7, 8, 9);
var_dump($var1, $var2, $var3);

echo '<hr>';

function someStaticData()
{
    static $qwerty = 0;

    $qwerty++;

    return $qwerty;
}

var_dump(someStaticData());
var_dump(someStaticData());
var_dump(someStaticData());
var_dump(someStaticData());
