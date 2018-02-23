<?php

function config($key, $default = null)
{
    global $config;

    return getFromArray($config, $key, $default);
}

/**
 * @param array $array
 * @param string $key
 * @param null $default
 * @return mixed|null
 */
function getFromArray(array $array, $key, $default = null)
{
    return array_key_exists($key, $array) ? $array[$key] : $default;
}

function toUrl($url)
{
    return config('baseUrl') . '/' . trim($url, '/');
}

function getUniqueFileName($dir, $fileExt)
{
    do {
        $hash = md5(time());
        $name = "{$hash}.{$fileExt}";
    } while (file_exists("{$dir}/{$name}"));

    return $name;
}

function redirect($url, $status = 301)
{
    header("Location: {$url}", $status);
    exit;
}

/** @var mysqli|null $dbConnection */
$dbConnection = null;

/**
 * @return mysqli|null
 */
function getDbConnection()
{
    global $dbConnection;

    if (null === $dbConnection) {
        $config = config('db');
        $dbConnection = mysqli_connect(
            $config['host'],
            $config['user'],
            $config['password'],
            $config['db']
        );
    }

    return $dbConnection;
}

function setUpModel($model)
{
    require_once config('modelsPath') . "/{$model}.php";
}
