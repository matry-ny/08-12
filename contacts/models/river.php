<?php

function getRiversList($limit = 10, $offset = 0, $orderBy = 'title')
{
    $db = getDbConnection();
    $query = mysqli_prepare($db, 'SELECT * FROM rivers ORDER BY ? LIMIT ? OFFSET ?');
    mysqli_stmt_bind_param($query, 'sii', $orderBy, $limit, $offset);

    mysqli_stmt_execute($query);

    mysqli_stmt_bind_result($query, $id, $title);

    $result = [];
    while (mysqli_stmt_fetch($query)) {
        $result[] = ['id' => $id, 'title' => $title];
    }

    return $result;
}

function getRiversQuantity()
{
    $db = getDbConnection();
    $query = mysqli_prepare($db, 'SELECT COUNT(1) FROM rivers');

    mysqli_stmt_execute($query);

    mysqli_stmt_bind_result($query, $quantity);
    mysqli_stmt_fetch($query);

    return $quantity;
}

function getRiverData($id, $withCountries = true)
{
    $db = getDbConnection();
    $query = mysqli_prepare($db, 'SELECT * FROM rivers WHERE id = ? LIMIT 1');
    mysqli_stmt_bind_param($query, 'i', $id);

    mysqli_stmt_execute($query);

    $result = mysqli_stmt_get_result($query);
    $data = mysqli_fetch_assoc($result);

    mysqli_free_result($result);

    if ($withCountries) {
        $data['countries'] = getCountriesByRiver($id);
    }

    return $data;
}

function getCountriesByRiver($riverId)
{
    $db = getDbConnection();

    $sql = <<<SQL
SELECT 
  cities.id,
  cities.title
FROM river_to_city 
INNER JOIN cities ON cities.id = river_to_city.city_id 
WHERE river_to_city.river_id = ?
SQL;
    
    $query = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($query, 'i', $riverId);

    mysqli_stmt_execute($query);

    $result = mysqli_stmt_get_result($query);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    mysqli_free_result($result);

    return $data;
}
