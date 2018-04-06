<?php

namespace app\common\components\db;

/**
 * Class Migration
 * @package common\components\db
 */
class Migration extends Model
{
    /**
     * @param string $name
     * @param array $fields
     * @return int
     * @throws \Exception
     */
    public function createTable($name, array $fields)
    {
        /** @var \app\common\components\db\events\CreateTable $query */
        $query = (new Query())->getBuilder(Query::CREATE_TABLE);
        return $query->create($name)->fields($fields)->execute();
    }

    /**
     * @param string $name
     * @return int
     * @throws \Exception
     */
    public function dropTable($name)
    {
        /** @var \app\common\components\db\events\DropTable $query */
        $query = (new Query())->getBuilder(Query::DROP_TABLE);
        return $query->drop($name)->execute();
    }

    /**
     * @param string $table
     * @param FieldType $column
     * @param null $after
     * @return int
     * @throws \Exception
     */
    public function addColumn($table, FieldType $column, $after = null)
    {
        /** @var \app\common\components\db\events\AddColumn $query */
        $query = (new Query())->getBuilder(Query::ADD_COLUMN);
        return $query->table($table)->column($column)->after($after)->execute();
    }

    /**
     * @param string $table
     * @param string $column
     * @return int
     * @throws \Exception
     */
    public function dropColumn($table, $column)
    {
        /** @var \app\common\components\db\events\DropColumn $query */
        $query = (new Query())->getBuilder(Query::DROP_COLUMN);
        return $query->table($table)->column($column)->execute();
    }

    /**
     * @param string $name
     * @param string $table
     * @param string $column
     * @param string $refTable
     * @param string $refColumn
     * @param string|null $onUpdate
     * @param string|null $onDelete
     * @return int
     * @throws \Exception
     */
    public function addForeignKey($name, $table, $column, $refTable, $refColumn, $onUpdate = null, $onDelete = null)
    {
        /** @var \app\common\components\db\events\AddForeignKey $query */
        $query = (new Query())->getBuilder(Query::ADD_FOREIGN_KEY);
        return $query
            ->key($name)
            ->table($table)
            ->column($column)
            ->targetTable($refTable)
            ->targetColumn($refColumn)
            ->onUpdate($onUpdate)
            ->onDelete($onDelete)
            ->execute();
    }

    /**
     * @param string $name
     * @param string $table
     * @return int
     * @throws \Exception
     */
    public function dropForeignKey($name, $table)
    {
        /** @var \app\common\components\db\events\DropForeignKey $query */
        $query = (new Query())->getBuilder(Query::DROP_FOREIGN_KEY);
        return $query->key($name)->table($table)->execute();
    }

    /**
     * @param string $name
     * @param string $table
     * @param string $column
     * @param bool $isUnique
     * @return int
     * @throws \Exception
     */
    public function createIndex($name, $table, $column, $isUnique = false)
    {
        /** @var \app\common\components\db\events\CreateIndex $query */
        $query = (new Query())->getBuilder(Query::CREATE_INDEX);
        return $query->key($name)->table($table)->column($column)->unique($isUnique)->execute();
    }

    /**
     * @param string $name
     * @param string $table
     * @return int
     * @throws \Exception
     */
    public function dropIndex($name, $table)
    {
        /** @var \app\common\components\db\events\DropIndex $query */
        $query = (new Query())->getBuilder(Query::DROP_INDEX);
        return $query->key($name)->table($table)->execute();
    }

    /**
     * @param string $name
     * @param int $length
     * @return FieldType|\app\common\components\db\fields\Integer
     */
    public function integer($name, $length)
    {
        return (new Field())->getBuilder(Field::INTEGER)->name($name)->length($length);
    }

    /**
     * @param string $name
     * @param int $length
     * @return FieldType|\app\common\components\db\fields\Varchar
     */
    public function varchar($name, $length)
    {
        return (new Field())->getBuilder(Field::VARCHAR)->name($name)->length($length);
    }

    /**
     * @param string $name
     * @return FieldType|\app\common\components\db\fields\TimeStamp
     */
    public function timestamp($name)
    {
        return (new Field())->getBuilder(Field::TIMESTAMP)->name($name);
    }

    /**
     * @param string $name
     * @return FieldType|\app\common\components\db\fields\Text
     */
    public function text($name)
    {
        return (new Field())->getBuilder(Field::TEXT)->name($name);
    }

    /**
     * @param $name
     * @param int $decimalSigns
     * @return FieldType|\app\common\components\db\fields\Decimal
     */
    public function decimal($name, $decimalSigns = 2)
    {
        return (new Field())->getBuilder(Field::DECIMAL)->name($name)->length($decimalSigns);
    }
}