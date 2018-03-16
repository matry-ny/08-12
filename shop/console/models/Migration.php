<?php

namespace app\console\models;

use app\common\Application;
use app\common\components\Model;
use PDO;

/**
 * Class Migration
 * @package app\console\models
 */
class Migration extends Model
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

        $sql = 'SHOW TABLES LIKE :table_name';
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':table_name', $table, PDO::PARAM_STR);

        $result = $stmt->execute();
        $exists = $result && $stmt->rowCount();

        if (!$exists) {
            $sql = <<<SQL
CREATE TABLE {$table} (
  id INT(11) AUTO_INCREMENT,
  migration VARCHAR(255),
  execution_date DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)
SQL;
            $this->getConnection()->query($sql)->execute();
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getExecuted(): array
    {
        $sql = "SELECT migration FROM {$this->tableName()}";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public function up($name)
    {
        $sql = "INSERT INTO {$this->tableName()} (migration) VALUES (:migration)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bindParam(':migration', $name, PDO::PARAM_STR);

        $stmt->execute();
    }
}