<?php

namespace app\console\models;

use app\common\Application;
use app\common\components\db\Expression;
use app\common\components\db\events\Select;

/**
 * Class Migration
 * @package app\console\models
 */
class Migration extends \app\common\components\db\Migration
{
    public function __construct()
    {
        $this->init();
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function tableName(): string
    {
        return Application::get()->param('migrations.table');
    }

    public function init()
    {
        $table = Application::get()->param('migrations.table');

        /** @var Select $isInitiated */
        $isInitiated = $this
            ->select(['table_name'])
            ->from('information_schema.tables')
            ->where([
                ['=', 'table_schema', Application::getDb()->getDataBaseName()],
                ['=', 'table_name', $this->tableName()]
        ]);

        if (!$isInitiated->exists()) {
            $this->createTable($table, [
                $this->integer('id', 11)->autoIncrement()->primaryKey(),
                $this->varchar('migration', 255),
                $this->timestamp('execution_date')->defaultValue(new Expression('CURRENT_TIMESTAMP'))
            ]);
        }
    }

    /**
     * @param int|null $limit
     * @return array
     * @throws \Exception
     */
    public function getExecuted($limit = null): array
    {
        /** @var Select $query */
        $query = $this->select(['migration'])->from($this->tableName());
        if ($limit) {
            $query->limit($limit);
        }

        return $query->orderBy('execution_date', SORT_DESC)->column();
    }

    /**
     * @param string $migration
     * @return int
     * @throws \Exception
     */
    public function saveMigration($migration)
    {
        return $this->insert($this->tableName(), ['migration' => $migration]);
    }

    /**
     * @param string $migration
     * @return int
     * @throws \Exception
     */
    public function revertMigration($migration)
    {
        return $this->delete($this->tableName(), [['=', 'migration', $migration]], 1);
    }
}