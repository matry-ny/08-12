<?php

$data = isset($_GET['data']) ? $_GET['data'] : '';

if (empty($data)) {
    $answer = ['status' => 400, 'message' => 'Data can not be empty'];
} else {
    $answer = ['status' => 200, 'message' => md5($data)];
}

header('Content-Type: application/json');
echo json_encode($answer);
