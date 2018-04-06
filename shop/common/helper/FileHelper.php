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
     * @param bool $withExt
     * @param array $excluded
     * @return array
     */
    public static function getList(string $dir, $withExt = true, $excluded = []): array
    {
        $elements = scandir($dir);
        $elements = array_filter($elements, function ($item) use ($excluded) {
            return !in_array($item, array_merge(['.', '..'], $excluded));
        });

        if (false === $withExt) {
            array_walk($elements, function (&$item) {
                $item = pathinfo($item, PATHINFO_FILENAME);
            });
        }

        return $elements;
    }
}
