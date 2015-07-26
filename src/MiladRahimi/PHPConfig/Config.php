<?php namespace MiladRahimi\PHPConfig;

/**
 * Class Config
 * Config class makes set configuration file accessible for users
 *
 * @package MiladRahimi\PHPConfig
 * @author Milad Rahimi <info@miladrahimi.com>
 */
class Config
{
    /**
     * Configuration file name
     *
     * @var string
     */
    private $file;

    /**
     * Configuration directory path
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
     * Constructor
     *
     * @param string|null $file : Configuration file name
     * @param string|null $directory : Configuration file directory
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
     * Get (fetch) data from configuration file
     * Parameters are optional
     *
     * @return array|string : specified value or array of values
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
                throw new PHPConfigException("Config file content is not valid");
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
            throw new InvalidArgumentException("File must be a string value");
        $this->file = $file;
    }

    /**
     * Set and get the config file path
     *
     * @param null|string $path : Configuration file path
     * @return bool|string : path (string) or success (bool)
     * @throws PHPConfigException
     */
    public function path($path = null)
    {
        if(!is_null($path)) {
            if (!is_string($path))
                throw new InvalidArgumentException("Path must be a string value");
            if (!file_exists($path) || is_dir($path))
                throw new PHPConfigException("Path must be a real file path");
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
            throw new InvalidArgumentException("Directory must be a string value");
        $this->directory = $directory;
    }

}