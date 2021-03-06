<?php

namespace app\common\components\db;
use app\common\Application;
use PDO;

/**
 * Class SelectIterator
 * @package app\common\components\db
 */
class SelectIterator implements \Iterator
{
    /**
     * @var string
     */
    private $query;

    /**
     * @var int
     */
    private $stack;

    /**
     * @var int
     */
    private $page = 1;

    /**
     * @var array
     */
    private $rows = [];

    /**
     * @var int
     */
    private $index;

    /**
     * SelectIterator constructor.
     * @param string $query
     * @param int $stack
     */
    public function __construct($query, $stack)
    {
        $this->index = 0;
        $this->stack = $stack;
        $this->query = $query;
    }

    public function rewind()
    {
        $this->index = 0;
        $this->loadStack();
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return $this->rows[$this->index];
    }

    /**
     * @return int|mixed
     */
    public function key()
    {
        return $this->index;
    }

    public function next()
    {
        ++$this->index;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        $isValid = isset($this->rows[$this->index]);
        if (!$isValid) {
            $this->loadStack($this->page);
        }

        return isset($this->rows[$this->index]);
    }

    /**
     * @param int $page
     */
    private function loadStack($page = 1)
    {
        $offset = ($page - 1) * $this->stack;
        $sql = "{$this->query} LIMIT {$this->stack} OFFSET {$offset}";

        $query = Application::getDb()->getConnection()->query($sql, PDO::FETCH_ASSOC);
        $query->execute();

        $rows = $query->fetchAll();
        $keys = array_slice(range($offset, $offset + $this->stack), 0, count($rows));
        $this->rows = array_combine($keys, $rows);

        $this->page++;
    }
}
