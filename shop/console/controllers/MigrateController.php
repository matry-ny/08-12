<?php

namespace app\console\controllers;

use app\common\Application;
use app\common\components\cli\Controller;
use app\common\components\MigratableIntarface;
use app\common\helper\FileHelper;
use app\console\models\Migration;

/**
 * Class MigrateController
 * @package app\console\controllers
 */
class MigrateController extends Controller
{
    /**
     * @var string
     */
    private $migrationsDir;

    /**
     * @var string
     */
    private $migrationsNamespace;

    public function __construct()
    {
        $this->migrationsDir = Application::get()->param('migrations.dir');
        $this->migrationsNamespace = Application::get()->param('migrations.namespace');
    }

    public function actionCreate($name)
    {
        $time = time();
        $migration = "m{$time}_{$name}";
        $namespace = Application::get()->param('migrations.namespace');

        $content = <<<PHP
<?php
        
namespace {$namespace};

use app\common\components\db\Migration;
use app\common\components\MigratableIntarface

/**
 * Class {$migration}
 * @package {$namespace}
 */
class {$migration} extends Migration implements MigratableIntarface
{
    public function up()
    {
    }
    
    public function down()
    {
    }
}

PHP;

        $dir = Application::get()->param('migrations.dir');
        $file = $dir . DIRECTORY_SEPARATOR . $migration . '.php';
        file_put_contents($file, $content);

        return $this->lineOut("Migration '{$migration}' created successfully");
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function actionUp()
    {
        $executedMigrations = $this->getModel()->getExecuted();
        $newMigrations = FileHelper::getList($this->migrationsDir, true, $executedMigrations);

        if (empty($newMigrations)) {
            return $this->lineOut('Database is up to date');
        }

        foreach ($newMigrations as $migration) {
            $migrationClass = $this->getMigrationClassName($migration);
            if (!class_exists($migrationClass)) {
                echo $this->lineOut("Migration '{$migration}' is not exists");
                continue;
            }

            $migrationObject = new $migrationClass();
            if (!$migrationObject instanceof MigratableIntarface) {
                echo $this->lineOut("Migration '{$migration}' has incorrect format");
                continue;
            }

            call_user_func([$migrationObject, 'up']);
            $this->getModel()->saveMigration($migration);

            echo $this->lineOut("Migration '{$migration}' executed");
        }

        return $this->lineOut('Database is up to date');
    }

    /**
     * @param int $limit
     * @return string
     * @throws \Exception
     */
    public function actionDown($limit = 1)
    {
        $deprecatedMigrations = $this->getModel()->getExecuted($limit);
        if (empty($deprecatedMigrations)) {
            return $this->lineOut('Nothing to revert');
        }

        $reverted = 0;
        foreach ($deprecatedMigrations as $migration) {
            $migrationClass = $this->getMigrationClassName($migration);
            if (!class_exists($migrationClass)) {
                echo $this->lineOut("Migration '{$migration}' is not exists");
                continue;
            }

            $migrationObject = new $migrationClass();
            if (!$migrationObject instanceof MigratableIntarface) {
                echo $this->lineOut("Migration '{$migration}' has incorrect format");
                continue;
            }

            call_user_func([$migrationObject, 'down']);
            $this->getModel()->revertMigration($migration);
            $reverted++;

            echo $this->lineOut("Migration '{$migration}' reverted");
        }

        return $this->lineOut("Reverted {$reverted} migrations");
    }

    /**
     * @param string $migration
     * @return string
     */
    private function getMigrationClassName($migration)
    {
        return vsprintf('\%s\%s', [$this->migrationsNamespace, substr($migration, 0, stripos($migration, '.php'))]);
    }

    /**
     * @return Migration
     */
    private function getModel(): Migration
    {
        return new Migration();
    }
}