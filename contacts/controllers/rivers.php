<?php

setUpModel('river');

function actionList()
{
    $page = (int)getFromArray($_GET, 'page', 1);
    $limit = (int)getFromArray($_GET, 'limit', 10);
    $offset = $limit * ($page - 1);

    return render('rivers/list', [
        'rivers' => getRiversList($limit, $offset),
        'pages' => ceil(getRiversQuantity() / $limit),
        'currentPage' => $page
    ]);
}

function actionView()
{
    $id = getFromArray($_GET, 'id');
    if (empty($id)) {
        die('River ID is required');
    }

    return render('rivers/form', [
        'data' => getRiverData($id),
        'action' => toUrl("/rivers/update?id={$id}")
    ]);
}

