<?php namespace Neatplex\PHPConfig;

/**
 * Class Config
 *
 * Config class is the main package class.
 * This class helps developer to access configuration files.
 *
 * @package Neatplex\PHPConfig
 *
 * @author Milad Rahimi <info@miladrahimi.com>
 */
class Config
{
    /**
     * Config file name
     *
     * @var string
     */
    private $name;

    /**
     * Config directory path
     *
     * @var string
     */
    private $directory;

    /**
     * Configuration file content
     *
     * @var array
     */
    private $content;

    /**
     * Construct
     *
     * @param null $file
     * @param null $directory
     * @throws InvalidArgumentException
     */
    public function __construct($file = null, $directory = null)
    {
        if (!is_null($file))
            $this->setName($file);
        if (!is_null($directory))
            $this->setDirectory($directory);
    }

    /**
     * Get data from configuration file
     *
     * @return array
     * @throws PHPConfigException
     */
    public function get()
    {
        $this->load();
        $r = $this->content;
        foreach (func_get_args() as $arg) {
            if (isset($r[$arg])) {
                $r = $r[$arg];
            } else {
                throw new PHPConfigException("Value not found");
            }
        }
        return $r;
    }

    /**
     * Load config file
     *
     * @throws PHPConfigException
     */
    private function load()
    {
        if (!is_array($this->content)) {
            $file = $this->directory . DIRECTORY_SEPARATOR . $this->name;
            if (!file_exists($file))
                throw new PHPConfigException("Config file not found");
            $content = include $file;
            if (!is_array($content))
                throw new PHPConfigException("Invalid config file content");
            $this->content = $content;
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @throws InvalidArgumentException
     */
    public function setName($name)
    {
        if (!isset($name) || !is_string($name))
            throw new InvalidArgumentException("Invalid file name");
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @param string $directory
     * @throws InvalidArgumentException
     */
    public function setDirectory($directory)
    {
        if (!isset($directory) || !is_string($directory))
            throw new InvalidArgumentException("Invalid directory path");
        $this->directory = $directory;
    }


}