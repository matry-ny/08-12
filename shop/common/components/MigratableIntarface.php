<?php

namespace app\common\components;

/**
 * Interface MigratableIntarface
 * @package app\common\components
 */
interface MigratableIntarface
{
    public function up();

    public function down();
}
