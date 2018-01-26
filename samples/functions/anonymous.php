<?php

function validate($value, Closure $callback)
{
    return $callback($value);
}

$attributes = [
    'name' => function ($value) {
        return is_string($value);
    },
    'phone' => function ($value) {
        $regexp = '/\+38\s\(0\d{2}\)\s\d{3}\-\d{2}\-\d{2}/';
        return (bool)preg_match($regexp, $value);
    }
];

$data = [
    'name' => 'Dmytro',
    'phone' => '+38 (050) 167-53-61',
    'age' => 21,
    'weight' => 66
];

foreach ($data as $key => $value) {
    $validator = array_key_exists($key, $attributes) ? $attributes[$key] : null;
    if (empty($validator)) {
        continue;
    }

    $result = validate($value, $validator);
    var_dump($result);
}

//function filterInt($value)
//{
//    return is_int($value);
//}
//
//$filtered = array_filter($data, 'filterInt');
//var_dump($filtered);
