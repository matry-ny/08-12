<?php

namespace app\common\components\db\events;

use app\common\components\db\Command;

/**
 * Class DropTable
 * @package common\components\db\events
 */
class DropTable extends Command
{
    /**
     * @param string $table
     * @return DropTable
     */
    public function drop($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @return string
     */
    public function build()
    {
        return "DROP TABLE {$this->table}";
    }
}