<?php

namespace app\common\components\db;

use PDO;
use app\common\components\db\commands\{
    AbstractCommand, Insert, Update
};

/**
 * Class Builder
 * @package app\common\components\db
 */
class Builder
{
    public const INSERT = 'insert';
    public const UPDATE = 'update';
    public const DELETE = 'delete';
    public const CREATE_TABLE = 'create_table';
    public const DROP_TABLE = 'drop_table';

    /**
     * @param string $command
     * @return string
     * @throws \Exception
     */
    private static function getCommand(string $command): string
    {
        $commands = [
            self::INSERT => Insert::class,
            self::UPDATE => Update::class
        ];

        if (!array_key_exists($command, $commands)) {
            throw new \Exception("Unknown command '{$command}'");
        }

        return $commands[$command];
    }

    /**
     * @param string $command
     * @param PDO $connection
     * @return AbstractCommand
     * @throws \Exception
     */
    public static function build(string $command, PDO $connection): AbstractCommand
    {
        $class = self::getCommand($command);
        return new $class($connection);
    }
}
