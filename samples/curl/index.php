<?php

error_reporting(E_ALL);

require_once __DIR__ . '/Curl.php';
$curl = new Curl('http://0812.shop.local/api/');

$rand = mt_rand();
$result = $curl->post('users/create', ['name' => "Generated With API #{$rand}"]);
var_dump($result);

$usersJson = $curl->get('users/get-list', ['test' => 1, 'qwerty' => 'strung rewr']);
$users = json_decode($usersJson, true);
var_dump($users);
