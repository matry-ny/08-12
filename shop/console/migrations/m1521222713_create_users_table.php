<?php
        
namespace app\console\migrations;

use app\common\Application;
use app\common\components\MigratableIntarface;

/**
 * Class m1521222713_create_users_table
 * @package app\console\migrations
 */
class m1521222713_create_users_table implements MigratableIntarface
{
    public function up()
    {
        $sql = <<<SQL
CREATE TABLE users (
  id INT(11) AUTO_INCREMENT,
  name VARCHAR(255),
  PRIMARY KEY (id)
)
SQL;
        Application::get()->getDb()->query($sql)->execute();
    }
    
    public function down()
    {
        $sql = 'DROP TABLE users';
        Application::get()->getDb()->query($sql)->execute();
    }
}
