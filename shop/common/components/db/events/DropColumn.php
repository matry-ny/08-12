<?php

namespace app\common\components\db\events;

use app\common\components\db\Command;

/**
 * Class DropColumn
 * @package common\components\db\events
 */
class DropColumn extends Command
{
    /**
     * @var string
     */
    private $column;

    /**
     * @param string $column
     * @return DropColumn
     */
    public function column($column)
    {
        $this->column = $column;
        return $this;
    }

    /**
     * @param string $table
     * @return DropColumn
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
        return "ALTER TABLE {$this->table} DROP COLUMN {$this->column}";
    }
}