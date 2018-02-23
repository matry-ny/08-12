<?php

$min = 1;
$max = 9;

for ($row = $min; $row <= $max; $row++) {
    for ($column = $min; $column <= $max; $column++) {
        $result = $row * $column;
        echo "{$row} x {$column} = {$result}<br>";
    }
    echo '<br>';
}
