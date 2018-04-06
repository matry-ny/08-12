<?php

namespace app\common\components\db\events;

use app\common\components\db\Command;

/**
 * Class Delete
 * @package common\components\db\events
 */
class Delete extends Command
{
    /**
     * @return Delete
     */
    public function delete()
    {
        return $this;
    }


    /**
     * @return string
     */
    public function build()
    {
        $conditions = $this->conditions();
        $sql = "DELETE FROM {$this->table}{$conditions}{$this->limit}";

         return $sql;
    }
}