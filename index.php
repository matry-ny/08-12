<?

// One line comment

# Other one line comment

/* Multi line comment with one line */

/*
 * Multi line comment
 * more lines
 * For great visualisation
 */

/*
Other
multi line
comment
*/

/**
 * @var string $test
 * @method testMethod
 * @return array
 */

$test = 1 + 4.2;

$r = 'm';
$q = 'r';
${"{$r}{$q}"} = 2;

var_dump($mr);

?>

<h1>Result: <?= $test ?></h1>

<?php

$test = 'test12test';

var_dump((bool)(int)$test);
var_dump(1 + '12 trst' + ' 1');

echo '---> <br>';

$x = true;
if ($x == 1) {
    echo 1;
}
if ($x == 2) {
    echo 2;
}
if ($x == 3) {
    echo 3;
}

echo '---> <br>';

$rand = mt_rand(1, 5);
if ($rand % 2 === 0) {
    echo "{$rand}: TRUE";
} else {
    echo "{$rand}: FALSE";
}

echo '---> <br>';
if ($rand == 1) {
    echo 'one';
} elseif ($rand == 2) {
    echo 'two';
} elseif ($rand == 3) {
    echo 'three';
} else {
    echo 'some else';
}

echo '---> <br>';

$e = print 'test';
var_dump($e);

$t = 1 + (print(2));
var_dump($t);