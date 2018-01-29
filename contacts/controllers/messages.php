<?php

function actionList()
{
    $storage = config('storagePath');
    $files = array_filter(scandir($storage), function ($item) {
        return !in_array($item, ['.', '..', '.gitignore']);
    });
    $messages = [];
    foreach ($files as $file) {
        $data = unserialize(file_get_contents("{$storage}/{$file}"));
        $messages[] = array_merge(['id' => $file], $data);
    }

    render('/messages/list', ['messages' => $messages]);
}

function actionCreate()
{
    $path = config('storagePath');
    $file = $path . '/' . getUniqueFileName($path, 'txt');

    $messageString = serialize($_POST);
    file_put_contents($file, $messageString);

    redirect(toUrl('/messages/list'));
}
