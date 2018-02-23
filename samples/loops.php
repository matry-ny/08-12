<?php

for ($i = 7; $i < 9; $i++) {
    var_dump("FOR >> {$i}");
}

$j = 5;
while ($j < 9) {
    var_dump("WHILE >> {$j}");
    $j += 2;
}

$count = 0;
$start = time();
while (time() < $start + 1) {
    $count++;
}

var_dump($count);

$k = 0;
do {
    var_dump("DO-WHILE: {$k}");
    $k++;
} while ($k > 4);

$array = [1, 2];
$array[17] = 33;
$array[5] = 55;
$array[88] = 'test';

var_dump($array);

foreach ($array as $key => $value) {
    var_dump("{$key} >> {$value}");
}

$array2 = [
    'test' => [
        [1, 2, 4],
        [5, 9, 41],
    ],
    'querty' => [
        [5, 6, 7],
        [15, 61, 171],
    ]
];
foreach ($array2 as $key => $value) {
    foreach ($value as $key2 => $value2) {
        foreach ($value2 as $key3 => $value3) {
            var_dump("array2[{$key}][{$key2}][{$key3}] = {$value3}");
        }
    }
}

$test = 0;
while ($test < 50) {
    if (in_array($test, [10, 15])) {
        $test += 5;
        continue;
    }

    if ($test > 30) {
        break;
    }

    var_dump($test);
    $test += 5;
}
