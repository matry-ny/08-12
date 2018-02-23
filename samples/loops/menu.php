<?php

$menu = [
    [
        'label' => 'Home',
        'url' => '/home'
    ],
    [
        'label' => 'Themes',
        'url' => '#'
    ],
    [
        'label' => 'Contacts',
        'url' => '/contacts'
    ]
];

$menuString = '<ul>';

foreach ($menu as $item) {
    $children = '';
//    if (array_key_exists('children', $item)) {
//        $children .= '<ul>';
//        foreach ($item['children'] as $child) {
//            $children .= "<li><a href='{$child['url']}'>{$child['label']}</a></li>";
//        }
//        $children .= '</ul>';
//    }
    $menuString .= "<li><a href='{$item['url']}'>{$item['label']}</a>{$children}</li>";
}

$menuString .= '</ul>';

echo $menuString;