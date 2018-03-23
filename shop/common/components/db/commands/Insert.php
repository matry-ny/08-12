<?php

namespace app\common\components\db\commands;

/**
 * Class Insert
 * @package app\common\components\db\commands
 */
class Insert extends AbstractCommand
{
    public function prepare()
    {
        $keys = array_keys($this->columns);

        $attributes = [];
        foreach ($keys as $key) {
            $attribute = ":{$key}";
            $attributes[] = $attribute;
            $this->params[$attribute] = $this->columns[$key];
        }

        $this->sql = 'INSERT INTO ' . $this->table . ' (' . implode(', ', $keys) . ') VALUES (' . implode(', ', $attributes) . ')';
    }
}