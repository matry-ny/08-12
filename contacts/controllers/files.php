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

function actionDeleteDir()
{
    $dir = urldecode($_GET['path']);

    rmdir("$dir");

    redirect(toUrl('/files/list?path=' . urlencode(pathinfo($dir, PATHINFO_DIRNAME))));
}

function actionDeleteFile()
{
    $file = urldecode($_GET['path']);
    unlink("$file");

    redirect(toUrl('/files/list?path=' . dirname($file)));
}

function actionUploadFile()
{
    error_reporting(E_ALL);

    if (empty($_FILES)) {
        return render('files/upload-file', ['path' => $_GET['path']]);
    }

    if ($_FILES['file']['tmp_name'][0]) {
        $filesArray = reArrayFiles($_FILES['file']);

        foreach ($filesArray as $file) {
            $files = "{$_POST['path']}/{$file['name']}";
            move_uploaded_file($file['tmp_name'], $files);
        }
    }

    redirect(toUrl('/files/list?path=' . urlencode($_POST['path'])));
}

function reArrayFiles(&$file_post) {

    $filesArray = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {
        foreach ($file_keys as $key) {
            $filesArray[$i][$key] = $file_post[$key][$i];
        }
    }

    return $filesArray;
}

