<?php

function config($key, $default = null)
{
    global $config;

    return array_key_exists($key, $config) ? $config[$key] : $default;
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
