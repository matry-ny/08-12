<?php

require_once __DIR__ . '/NotFoundException.php';

try {
    if (mt_rand(0, 1) == 1) {
        throw new NotFoundException();
    } else {
        throw new Exception('Test exception');
    }
} catch (NotFoundException $exception) {
    var_dump($exception);
} catch (Exception $exception) {
    var_dump($exception);
} finally {
    var_dump('Finally');
}

var_dump('After exception');
