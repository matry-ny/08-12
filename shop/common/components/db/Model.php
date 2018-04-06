<?php

namespace app\common\components\db;

use app\common\Application;

/**
 * Class Model
 * @package common\components\db
 */
class Model
{
    /**
     * @param array $fields
     * @return \app\common\components\db\events\Select
     */
    public function select(array $fields)
    {
        /** @var \app\common\components\db\events\Select $query */
        $query = (new Query())->getBuilder(Query::SELECT);
        return $query->select($fields);
    }

    /**
     * @param string $table
     * @param array $fields
     * @return int
     * @throws \Exception
     */
    public function insert($table, array $fields)
    {
        /** @var \app\common\components\db\events\Insert $query */
        $query = (new Query())->getBuilder(Query::INSERT);
        return $query->insert($fields)->into($table)->execute();
    }

    /**
     * @param string $table
     * @param array $fields
     * @param array $conditions
     * @return int
     * @throws \Exception
     */
    public function update($table, array $fields, array $conditions)
    {
        /** @var \app\common\components\db\events\Update $query */
        $query = (new Query())->getBuilder(Query::UPDATE);
        return $query->update($table)->set($fields)->where($conditions)->execute();
    }

    /**
     * @param string $table
     * @param array $conditions
     * @param null $limit
     * @return int
     * @throws \Exception
     */
    public function delete($table, array $conditions = [], $limit = null)
    {
        /** @var \app\common\components\db\events\Delete $query */
        $query = (new Query())->getBuilder(Query::DELETE);
        $query->delete()->from($table)->where($conditions);
        if ($limit) {
            $query->limit($limit);
        }

        return $query->execute();
    }

    /**
     * @return string
     */
    public function lastInsertId()
    {
        return Application::getDb()->getConnection()->lastInsertId();
    }
}
