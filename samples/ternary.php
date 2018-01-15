<?php

error_reporting(E_ALL);

if (1 < 2) {
    echo 'OK';
} else {
    echo 'FAIL';
}

echo '<hr>';

echo 1 < 2 ? 'OK' : 'FAIL';

echo '<hr>';

echo 1 > 2 ? 'OK' : 5 > 6 ? 4 == 3 ? 'OKOKOK' : 'NOT OK' : 'FAIL';

echo '<hr>';

$r = 0;
echo $r ?: 'FAIL';

echo '<hr>';

$rr = null;
var_dump(isset($rr));
