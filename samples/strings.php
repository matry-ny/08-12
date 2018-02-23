<?php

$test = 123;

$str = <<<JS
// alert({$test});
JS;

echo "<script>{$str}</script>";