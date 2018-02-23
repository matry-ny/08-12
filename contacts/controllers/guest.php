<?php

setUpModel('user');

function actionLogin()
{
    return render('guest/login');
}

function actionAuth()
{
    $user = getUser($_POST['login']);
    if (empty($user)) {
        die('User is not exists');
    }

    $isCorrectPassword = $user['password'] == hashPassword($_POST['password']);
    if (!$isCorrectPassword) {
        die('Password is not correct');
    }

    login($user);

    redirect(toUrl('files/list'));
}

function actionRegistration()
{
    return render('guest/registration');
}

function actionCreateAccount()
{
    $isCorrectPassword = $_POST['password'] == $_POST['repeat_password'];
    if (!$isCorrectPassword) {
        exit('Password is not equals');
    }

    $user = getUser($_POST['login']);
    if ($user) {
        die('User is not unique');
    }

    $users[] = [
        'login' => $_POST['login'],
        'password' => hashPassword($_POST['password'])
    ];

    refreshUsers($users);

    redirect(toUrl('guest/login'));
}

function actionLogout()
{
    logout();
    redirect(toUrl('/guest/login'));
}
