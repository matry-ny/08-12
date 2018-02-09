<?php

if (empty(session_id())) {
    session_start();
}

/**
 * @return bool
 */
function isGuest()
{
    return !array_key_exists('user', $_SESSION) || empty($_SESSION['user']);
}

/**
 * @param array $user
 */
function login(array $user)
{
    $_SESSION['user'] = $user;
}

function logout()
{
    session_destroy();
}
