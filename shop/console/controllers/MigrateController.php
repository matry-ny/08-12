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
    public function actionCreate($name)
    {
        $time = time();
        $migration = "m{$time}_{$name}";
        $namespace = Application::get()->param('migrations.namespace');

        $content = <<<PHP
<?php
        
namespace {$namespace};

use app\common\components\MigratableIntarface

/**
 * Class {$migration}
 * @package {$namespace}
 */
class {$migration} implements MigratableIntarface
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

    public function actionUp()
    {
        $executed = $this->getModel()->getExecuted();
        $all = FileHelper::getList(Application::get()->param('migrations.dir'), false);
        $new = array_diff($all, $executed);

        if (empty($new)) {
            return $this->lineOut('DB is up to date');
        }

        echo $this->lineOut('Executing ' . count($new) . ' migrations...');

        $namespace = Application::get()->param('migrations.namespace');
        foreach ($new as $migration) {
            $name = str_replace('.php', '', $migration);
            $class = $namespace . '\\' . $name;
            $object = new $class();

            if (!$object instanceof MigratableIntarface) {
                return $this->lineOut("Migration '{$name}' can not be processed");
            }

            $object->up();
            $this->getModel()->up($name);

            echo $this->lineOut("Migration '{$name}' done");
        }

        return $this->lineOut('DB is up to date');
    }

    public function actionDown()
    {
    }

    /**
     * @return Migration
     */
    private function getModel(): Migration
    {
        return new Migration();
    }
}