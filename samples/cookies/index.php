<?php

setcookie('test-group', '0812', time() + 60 * 5, '/', '.0812.local', false, false);
var_dump($_COOKIE['test-group']);

session_start();

var_dump(session_save_path());

$_SESSION['qwerty'] = 123;
var_dump($_SESSION['qwerty']);

