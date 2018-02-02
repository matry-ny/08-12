<?php

/**
 * @var string $name
 * @var array $messages
 */

?>
<h1>Messages list</h1>

<form action="<?= toUrl('messages/create') ?>" method="post">
    <input type="text" name="author" placeholder="Enter your name" class="form-control">
    <textarea name="message" placeholder="Enter your message" class="form-control mt-2"></textarea>

    <button type="submit" class="btn btn-success mt-2">Save</button>
</form>

<table>
    <?php foreach ($messages as $message) : ?>
        <tr>
            <td><?= $message['author'] ?></td>
            <td><?= $message['message'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>