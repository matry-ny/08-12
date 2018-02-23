<?php

/**
 * @var array $rivers
 * @var int $pages
 * @var int $currentPage
 */

?>
<table class="table table-striped">
    <tr>
        <th width="10%">ID</th>
        <th>Title</th>
        <th width="10%"></th>
    </tr>
    <?php foreach ($rivers as $river) : ?>
        <tr>
            <td><?= $river['id'] ?></td>
            <td><?= $river['title'] ?></td>
            <td><a class="btn btn-info" href="<?= toUrl("/rivers/view?id={$river['id']}")?>">View</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<ul class="pagination">
<?php for ($i = 1; $i <= $pages; $i++) : ?>
    <li class="page-item <?= $currentPage == $i ? 'active' : '' ?>">
        <a class="page-link" href="<?= toUrl("/rivers/list?page={$i}") ?>"><?= $i ?></a>
    </li>
<?php endfor; ?>
</ul>
