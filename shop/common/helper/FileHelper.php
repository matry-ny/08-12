<?php

namespace app\common\helper;

/**
 * Class FileHelper
 * @package app\common\helper
 */
class FileHelper
{
    /**
     * @param string $dir
     * @return array
     */
    public static function getList(string $dir, $withExt = true): array
    {
        $elements = scandir($dir);
        $elements = array_filter($elements, function ($item) {
            return !in_array($item, ['.', '..']);
        });

        if (false === $withExt) {
            array_walk($elements, function (&$item) {
                $item = pathinfo($item, PATHINFO_FILENAME);
            });
        }

        return $elements;
    }
}
