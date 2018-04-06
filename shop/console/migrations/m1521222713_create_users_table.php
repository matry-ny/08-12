<?php
        
namespace app\console\migrations;

use app\common\components\db\Migration;
use app\common\components\MigratableIntarface;

/**
 * Class m1521222713_create_users_table
 * @package app\console\migrations
 */
class m1521222713_create_users_table extends Migration implements MigratableIntarface
{
    public function up()
    {
        $this->createTable('users', [
            $this->integer('id', 11)->autoIncrement()->primaryKey(),
            $this->varchar('name', 255)
        ]);
    }
    
    public function down()
    {
        $this->dropTable('users');
    }
}
