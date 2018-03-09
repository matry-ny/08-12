<?php

namespace app\lib;

/**
 * Class ClassLoader
 * @package app\lib
 */
class ClassLoader
{
    /**
     * @var string
     */
    private $baseDir;

    /**
     * @var string
     */
    private $baseNamespace;

    /**
     * ClassLoader constructor.
     * @param string $baseDir
     * @param null|string $baseNamespace
     */
    public function __construct(string $baseDir, string $baseNamespace = null)
    {
        $this->baseDir = trim($baseDir, " \t\n\r\0\x0B\\");
        $this->baseNamespace = $baseNamespace;
    }

    public function load(string $className)
    {
        $ds = DIRECTORY_SEPARATOR;
        $class = $this->clearNamespace($className);
        $file = $this->baseDir . $ds . str_replace('\\', $ds, $class) . '.php';

        if (!file_exists($file)) {
            die("Class \"{$className}\" is not exists");
        }

        require_once $file;
    }

    private function clearNamespace($class)
    {
        if ($this->baseNamespace && stripos($class, $this->baseNamespace) === 0) {
            $class = substr($class, strlen($this->baseNamespace));
        }

        return trim($class, " \t\n\r\0\x0B\\");
    }
}
