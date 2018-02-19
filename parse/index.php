<?php

error_reporting(E_ALL);

$url = 'https://en.wikipedia.org/wiki/List_of_rivers_by_length';
$content = file_get_contents($url);

$dom = new DOMDocument();
$dom->loadHTML($content);

$riversTable = getRiversTable($dom);
if (empty($riversTable)) {
    die('Rivers table can not be parsed');
}

$db = mysqli_connect('localhost', 'root', 'ngJxC3h8', '0812_samples');

$rows = parseRows($riversTable->getElementsByTagName('tr'));
saveRows($db, $rows);

/**
 * @param DOMDocument $dom
 * @return DOMElement|null
 */
function getRiversTable(DOMDocument $dom)
{
    foreach ($dom->getElementsByTagName('table') as $item) {
        /** @var DOMElement $item */
        if ($item->getAttribute('class') == 'wikitable sortable') {
            return $item;
        }
    }

    return null;
}

/**
 * @param DOMNodeList $rows
 * @return array
 */
function parseRows(DOMNodeList $rows)
{
    $data = [];
    $headers = [];
    foreach ($rows as $row) {
        /** @var DOMElement $row */
        $headItems = $row->getElementsByTagName('th');
        if ($headItems->length) {
            $headers = parseHeaders($headItems);
            continue;
        }

        $data[] = parseColumns($row->getElementsByTagName('td'), $headers);
    }

    return $data;
}

/**
 * @param DOMNodeList $headers
 * @return array
 */
function parseHeaders(DOMNodeList $headers)
{
    $result = [];
    foreach ($headers as $header) {
        $result[] = $header->nodeValue;
    }

    return $result;
}

/**
 * @param DOMNodeList $columns
 * @param array $headers
 * @return array
 */
function parseColumns(DOMNodeList $columns, array $headers)
{
    $result = [];
    foreach ($columns as $index => $column) {
        $result[$headers[$index]] = $column->nodeValue;
    }

    return $result;
}

function saveRows(mysqli $db, array $rows)
{
    $newRiverSQL = mysqli_prepare($db, 'INSERT INTO rivers (title) VALUES (?)');
    foreach ($rows as $row) {
        $river = normalizeName($row['River']);
        $riverId = getRiverId($db, $river);
        if (empty($riverId)) {
            mysqli_stmt_bind_param($newRiverSQL, 's', $river);
            mysqli_stmt_execute($newRiverSQL);

            $riverId = mysqli_insert_id($db);
        }

        $countries = explode(', ', $row['Countries in the drainage basin[citation needed]']);
        foreach ($countries as &$country) {
            $country = normalizeName($country);
        }

        $countries = createCountries($db, $countries);
        createRelations($db, $riverId, $countries);
    }
}

function normalizeName($name, $symbols = ['(', '['])
{
    foreach ($symbols as $symbol) {
        if (($symbolPosition = mb_stripos($name, $symbol)) !== false) {
            $name = mb_substr($name, 0, $symbolPosition);
        }
    }

    return trim($name);
}

function getRiverId(mysqli $db, $riverName)
{
    $sql = mysqli_prepare($db, 'SELECT id FROM rivers WHERE title = ?');
    mysqli_stmt_bind_param($sql, 's', $riverName);
    mysqli_stmt_execute($sql);
    mysqli_stmt_bind_result($sql, $id);
    mysqli_stmt_fetch($sql);

    return $id;
}

function createCountries(mysqli $db, array $countries)
{
    $allSql = 'SELECT id, title FROM cities WHERE title IN ("' . implode('", "', $countries) . '")';
    $result = mysqli_query($db, $allSql);

    $existedIds = [];
    $existed = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $existedIds[] = $row['id'];
        $existed[] = $row['title'];
    }

    $new = array_diff($countries, $existed);
    if ($new) {
        $newSql = 'INSERT INTO cities (title) VALUES ("' . implode('"), ("', $new) . '")';
        mysqli_query($db, $newSql);

        $sql = 'SELECT id FROM cities WHERE title IN ("' . implode('", "', $new) . '")';
        $result = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $existedIds[] = $row['id'];
        }
    }

    return $existedIds;
}

function createRelations(mysqli $db, $riverId, array $countries)
{
    $rows = [];
    foreach ($countries as $countryId) {
        $rows[] = "({$riverId}, {$countryId})";
    }

    $sql = 'INSERT INTO river_to_city (river_id, city_id) VALUES ' . implode(',', $rows);
    mysqli_query($db, $sql);
}
