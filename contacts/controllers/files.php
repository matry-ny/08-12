<?php

function actionList()
{
    $listUrl = '/files/list';
    $viewUrl = '/files/view';

    $currentDir = isset($_GET['path']) ? realpath(urldecode($_GET['path'])) : __DIR__;
    $data = [];
    foreach (scandir($currentDir) as $item) {
        $path = "{$currentDir}/{$item}";
        $isDirectory = is_dir($path);

        $action = $isDirectory ? $listUrl : $viewUrl;

        $data[] = [
            'name' => $item,
            'url' => toUrl($action . '?path=' . urlencode($path)),
            'is_dir' => $isDirectory
        ];
    }

    return render('files/list', ['data' => $data, 'currentDir' => $currentDir]);
}

function actionView()
{
    $file = urldecode($_GET['path']);
    $fileResource = fopen($file, 'r');

    $content = '';
    while ($part = fread($fileResource, 2)) {
        $content .= htmlspecialchars($part);
    }

    fclose($fileResource);

    return render('files/view', [
        'content' => $content,
        'file' => $file,
        'back' => toUrl('/files/list?path=' . dirname($file))
    ]);
}

function actionCreateDir()
{
    $dirName = isset($_POST['dir_name']) ? $_POST['dir_name'] : null;
    if (empty($dirName)) {
        return render('files/create-dir', ['path' => urldecode($_GET['path'])]);
    }

    $dir = $_POST['path'];
    if (!is_writeable($dir)) {
        return render('files/error', ['message' => 'You can not write here']);
    }

    $newDir = "{$dir}/{$dirName}";
    mkdir($newDir);
    redirect(toUrl('/files/list?path=' . urlencode($newDir)));
}

function actionUploadFile()
{
    if (empty($_FILES)) {
        return render('files/upload-file', ['path' => $_GET['path']]);
    }

    $fileData = $_FILES['file'];

    $file = "{$_POST['path']}/{$fileData['name']}";
    move_uploaded_file($fileData['tmp_name'], $file);

    redirect(toUrl('/files/view?path=' . urlencode($file)));
}
