<?php

function printRange($min, $max)
{
    for ($i = $min; $i <= $max; $i++) {
        yield $i;
    }
}

//var_dump(intval(PHP_INT_MAX + 1));

//foreach (printRange(PHP_INT_MIN, PHP_INT_MAX) as $item) {
//    echo $item;
//}

$t = 1;
switch ($t) {
    case 2:
        var_dump(2);
        break;
    case true:
        var_dump('true');
        break;
    case 1;
        var_dump(1);
        break;
}
