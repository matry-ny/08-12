<?php

function printRange($min, $max)
{
    for ($i = $min; $i <= $max; $i++) {
        yield $i;
    }
}

var_dump(intval(PHP_INT_MAX + 1));

//foreach (printRange(PHP_INT_MIN, PHP_INT_MAX) as $item) {
//    echo $item;
//}
