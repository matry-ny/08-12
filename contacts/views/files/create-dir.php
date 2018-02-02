<?php

/**
 * @var string $path
 */

?>

<h3>Enter new directory name</h3>

<form action="<?= toUrl('/files/createDir') ?>" method="post">
    <input type="hidden" name="path" value="<?= $path ?>">
    <input type="text" name="dir_name" placeholder="Directory name" class="form-control mb-2">

    <input type="submit" class="btn btn-success" value="Create">
</form>
