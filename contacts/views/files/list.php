<?php

/**
 * @var array $data
 * @var string $currentDir
 */

?>
<h1>Files list</h1>
<ul>
    <li><a href="<?= toUrl('/files/createDir?path=' . urlencode($currentDir)) ?>">Create directory</a></li>
    <li><a href="<?= toUrl('/files/uploadFile?path=' . urlencode($currentDir)) ?>">Upload file</a></li>
</ul>

<ul>
<?php foreach ($data as $item) : ?>
    <li>
        <a href="<?= $item['url'] ?>">
            <i class="fa <?= $item['is_dir'] ? 'fa-folder' : 'fa-file' ?>"></i>
            <?= $item['name'] ?>
        </a>
        <a href="<?= $item['is_dir'] ? toUrl('/files/deleteDir?path='. urlencode($currentDir . '/' . $item['name'])) : toUrl('/files/deleteFile?path='. urlencode($currentDir . '/' . $item['name'])) ?>">
            <i class="far fa-trash-alt"></i>
        </a>

    </li>
<?php endforeach; ?>
</ul>
