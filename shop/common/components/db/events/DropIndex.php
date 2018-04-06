<?php

namespace app\common\components\db\events;

use app\common\components\db\Command;

/**
 * Class DropIndex
 * @package common\components\db\events
 */
class DropIndex extends Command
{
    /**
     * @var string
     */
    private $key;

    /**
     * @param string $key
     * @return DropIndex
     */
    public function key($key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @param string $table
     * @return DropIndex
     */
    public function table($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @return string
     */
    public function build()
    {
        return "DROP INDEX `{$this->key}` ON {$this->table}";
    }
}