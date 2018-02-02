<?php

/**
 * @var string $path
 */

?>

<h3>Upload file</h3>

<form action="<?= toUrl('/files/uploadFile') ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="path" value="<?= $path ?>">
    <input type="file" name="file">

    <input type="submit" value="Upload" class="btn btn-success">
</form>
