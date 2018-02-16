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

$rows = parseRows($riversTable->getElementsByTagName('tr'));
saveRows($rows);

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

function saveRows(array $rows)
{
//    foreach ($rows as $row) {
//        $countries = explode(', ', $row['Countries in the drainage basin[citation needed]']);
//    }
}
