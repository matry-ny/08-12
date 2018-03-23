<?php

namespace app\common\components\db\commands;

use PDO;

/**
 * Class AbstractCommand
 * @package app\common\components\db\commands
 */
abstract class AbstractCommand
{
    /**
     * @var PDO
     */
    private $connection;

    /**
     * AbstractCommand constructor.
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @var string
     */
    protected $sql;

    /**
     * @var array
     */
    protected $params = [];

    abstract public function prepare();

    /**
     * @var string
     */
    protected $table;

    /**
     * @param string $table
     * @return AbstractCommand
     */
    public function table(string $table): AbstractCommand
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @var array
     */
    protected $columns;

    /**
     * @param array $columns
     * @return AbstractCommand
     */
    public function columns(array $columns): AbstractCommand
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * @var array
     */
    protected $conditions = [];

    /**
     * @param array $conditions
     * @return AbstractCommand
     */
    public function where(array $conditions): AbstractCommand
    {
        $this->conditions[] = $conditions;
        return $this;
    }

    /**
     * @param array $conditions
     * @return AbstractCommand
     */
    public function andWhere(array $conditions): AbstractCommand
    {
        $this->conditions[] = $conditions;
        return $this;
    }

    /**
     * @param array $conditions
     * @return AbstractCommand
     */
    public function orWhere(array $conditions): AbstractCommand
    {
        $this->conditions[] = $conditions;
        return $this;
    }

    /**
     * @param bool $debug
     * @return bool
     */
    public function execute($debug = false): bool
    {
        $this->prepare();

        $stmt = $this->connection->prepare($this->sql);
        $result = $stmt->execute($this->params);

        if ($debug) {
            var_dump($this->connection->errorInfo());
        }

        return $result;
    }
}
