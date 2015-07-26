<?php namespace MiladRahimi\PHPConfig;

/**
 * Class Config
 * Config class is the main package class.
 * This class helps developer to access configuration files.
 *
 * @package MiladRahimi\PHPConfig
 * @author Milad Rahimi <info@miladrahimi.com>
 */
class Config
{
    /**
     * Config file name
     *
     * @var string
     */
    private $file;

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
            $this->setFile($file);
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
            $file = $this->directory . DIRECTORY_SEPARATOR . $this->file;
            if (!file_exists($file) || is_dir($file))
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
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param string $file
     * @throws InvalidArgumentException
     */
    public function setFile($file)
    {
        if (!isset($file) || !is_string($file))
            throw new InvalidArgumentException("Invalid file name");
        $this->file = $file;
    }

    /**
     * Set and get the config file path
     *
     * @param null $path
     * @return bool|string
     * @throws PHPConfigException
     */
    public function path($path = null)
    {
        if(!is_null($path)) {
            if (!is_string($path))
                throw new InvalidArgumentException("Invalid config file path");
            if (!file_exists($path) || is_dir($path))
                throw new PHPConfigException("Invalid path");
            $this->setDirectory(dirname($path));
            $this->setFile(basename($path));
            return true;
        } else {
            if(is_null($this->directory) && is_null($this->file))
                return null;
            $path = "";
            if(!is_null($this->directory))
                $path .= $this->directory . DIRECTORY_SEPARATOR;
            if(!is_null($this->file))
                $path .= $this->file;
            return $path;
        }
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