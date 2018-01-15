<?php

error_reporting(E_ALL);

$array = array(1, 2, 4, 5, -4, 0);
asort($array);
$first = array_shift($array);
var_dump($first, $array);

$array = [5, 4, 6, 2];
$array[] = 8;
$array[5] = 9;
array_push($array, 10);
array_push($array, 11);
array_push($array, 9);
array_push($array, 4);
array_push($array, 2);
unset($array[2]);

$requiredIndex = array_key_exists(2, $array) ? $array[2] : 'ERROR';
echo "Required index #2: {$requiredIndex}<br>";

$valueExists = in_array(10, $array) ? 'OK' : 'ERROR';
echo "Required value '10': {$valueExists}<br>";

var_dump($array, array_unique($array), compact('requiredIndex', 'valueExists', 'array'));

var_dump(serialize($array));

$array = [
    3 => 123,
    'test' => 333,
    5555,
    4 => 312
];
var_dump($array);

$menu = [
    [
        'title' => 'Home',
        'url' => '/samples',
        'position' => 1
    ],
    [
        'title' => 'About Us',
        'url' => '/about',
        'position' => 3
    ],
    [
        'title' => 'Samples',
        'url' => '#',
        'position' => 2,
        'children' => [
            [
                'title' => 'Strings',
                'url' => '/samples/strings.php'
            ],
            [
                'title' => 'Ternary',
                'url' => '/samples/ternary.php'
            ]
        ]
    ]
];
$menu[0]['title'] = 'Main';
$menu[2]['children'][1]['title'] = 'Ternary operators';
$menu[2]['children'][] = ['title' => 'Variables', 'url' => '/samples/variables.php'];

var_dump($menu);
//echo '<pre>';
//print_r($menu);
//echo '</pre>';

$serialized = serialize($menu);

$GLOBALS['menu'] = 'OXOXO';
var_dump($menu);
