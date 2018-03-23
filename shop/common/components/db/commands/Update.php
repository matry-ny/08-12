<?php

namespace app\common\components\db\commands;

/**
 * Class Update
 * @package app\common\components\db\commands
 */
class Update extends AbstractCommand
{
    public function prepare()
    {
        $keys = array_keys($this->columns);

        $attributes = [];
        foreach ($keys as $key) {
            $attribute = ":{$key}";
            $attributes[] = "{$key} = {$attribute}";
            $this->params[$attribute] = $this->columns[$key];
        }

        $this->sql = 'UPDATE ' . $this->table . ' SET ' . implode(', ', $attributes);
        if ($this->conditions) {
            $this->sql .= ' WHERE ';
            $conditions = [];
            foreach ($this->conditions as $column => $condition) {
                $conditionAttribute = ":{$column}";
                $conditions[] = "{$column} = {$conditionAttribute}";
                $this->params[$conditionAttribute] = $condition;
            }

            $this->sql .= implode(' AND ', $conditions);
        }
    }
}