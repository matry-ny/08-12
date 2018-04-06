<?php

namespace app\common\components;

use PDO;

/**
 * Class Database
 * @package app\common\components
 */
class Database
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $user;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $db;

    /**
     * Database constructor.
     * @param string $host
     * @param string $user
     * @param string $password
     * @param string $db
     */
    public function __construct($host, $user, $password, $db)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;
    }

    /**
     * @var null|PDO
     */
    private $connection = null;

    /**
     * @return string
     */
    public function getDataBaseName()
    {
        return $this->db;
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        if ($this->connection === null) {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->password);
        }

        return $this->connection;
    }
}
