<?php

declare(strict_types=1);

namespace app;

/**
 * Class FaceControl
 * @package app
 */
trait FaceControl
{
    /**
     * @param int $age
     * @return bool
     */
    public function isAdult(int $age): bool
    {
        return $age >= 18;
    }

    /**
     * @return string
     */
    private function getName(): string
    {
        $rand = mt_rand();
        return "Security #{$rand}<br>";
    }
}
