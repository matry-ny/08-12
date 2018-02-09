<?php

$basePath = dirname(__DIR__);

return [
    'baseUrl' => '/contacts',
    'controllersPath' => "{$basePath}/controllers",
    'viewsPath' => "{$basePath}/views",
    'storagePath' => "{$basePath}/storage",
    'guestPages' => [
        'guest/login',
        'guest/auth',
        'guest/registration',
        'guest/createAccount'
    ],
    'databasePath' => "{$basePath}/database",
    'modelsPath' => "{$basePath}/models"
];
