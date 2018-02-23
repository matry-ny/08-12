<?php

function getUser($login)
{
    $usersFile = config('databasePath') . '/users.json';
    $users = json_decode(file_get_contents($usersFile), true);

    return current(array_filter($users, function ($item) use ($login) {
        return $item['login'] == $login;
    }));
}

function refreshUsers(array $users)
{
    $usersFile = config('databasePath') . '/users.json';
    return file_put_contents($usersFile, json_encode($users));
}

function hashPassword($password)
{
    return md5($password);
}
