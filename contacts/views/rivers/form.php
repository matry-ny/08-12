<?php

/**
 * @var array $data
 * @var string $action
 */

?>

<form action="<?= $action ?>" method="post">
    <input class="form-control mb-2"
           name="title"
           placeholder="River name"
           value="<?= getFromArray($data, 'title') ?>">

    <input class="btn btn-success" type="submit" value="Save">
</form>
