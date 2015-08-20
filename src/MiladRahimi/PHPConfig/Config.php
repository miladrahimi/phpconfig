<?php namespace MiladRahimi\PHPConfig;

use MiladRahimi\PHPConfig\Exceptions\BadContentException;
use MiladRahimi\PHPConfig\Exceptions\FileNotFoundException;
use MiladRahimi\PHPConfig\Exceptions\InvalidArgumentException;
use MiladRahimi\PHPConfig\Exceptions\InvalidPathException;
use MiladRahimi\PHPConfig\Exceptions\KeyNotFoundException;

/**
 * Class Config
 * Config class accesses configuration files and share them via simple methods
 *
 * @package MiladRahimi\PHPConfig
 * @author  Milad Rahimi <info@miladrahimi.com>
 */
class Config {
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
     * @param string|null $directory Configuration file directory
     * @param string|null $file      Configuration file name
     */
    public function __construct($directory = null, $file = null) {
        if (!is_null($file)) {
            $this->setFile($file);
        }
        if (!is_null($directory)) {
            $this->setDirectory($directory);
        }
    }

    /**
     * Get (fetch) data from configuration file
     * Parameters are optional
     *
     * @return array|string : specified value or array of values
     *
     * @throws \MiladRahimi\PHPConfig\Exceptions\KeyNotFoundException
     */
    public function get() {
        $this->load();
        $r = $this->content;
        foreach (func_get_args() as $arg) {
            if (isset($r[$arg])) {
                $r = $r[$arg];
            } else {
                throw new KeyNotFoundException();
            }
        }
        return $r;
    }

    /**
     * Load config file
     *
     * @throws BadContentException
     * @throws FileNotFoundException
     */
    private function load() {
        if (!is_array($this->content)) {
            $file = $this->directory . DIRECTORY_SEPARATOR . $this->file;
            if (!file_exists($file) || is_dir($file)) {
                throw new FileNotFoundException();
            }
            /** @noinspection PhpIncludeInspection */
            $content = include $file;
            if (!is_array($content)) {
                throw new BadContentException();
            }
            $this->content = $content;
        }
    }

    /**
     * @return string
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * @param string $file
     *
     * @throws InvalidArgumentException
     */
    public function setFile($file) {
        if (!isset($file) || !is_string($file)) {
            throw new InvalidArgumentException("File must be a string value");
        }
        $this->file = $file;
    }

    /**
     * Set and get the config file path
     *
     * @param null|string $path : Configuration file path
     *
     * @return bool|string : path (string) or success (bool)
     * @throws InvalidPathException
     */
    public function path($path = null) {
        if (!is_null($path)) {
            if (!is_string($path)) {
                throw new InvalidArgumentException("Path must be a string value");
            }
            if (!file_exists($path) || is_dir($path)) {
                throw new InvalidPathException("Path must be a real file path");
            }
            $this->setDirectory(dirname($path));
            $this->setFile(basename($path));
            return true;
        } else {
            if (is_null($this->directory) && is_null($this->file)) {
                return null;
            }
            $path = "";
            if (!is_null($this->directory)) {
                $path .= $this->directory . DIRECTORY_SEPARATOR;
            }
            if (!is_null($this->file)) {
                $path .= $this->file;
            }
            return $path;
        }
    }

    /**
     * @return string
     */
    public function getDirectory() {
        return $this->directory;
    }

    /**
     * @param string $directory
     *
     * @throws InvalidArgumentException
     */
    public function setDirectory($directory) {
        if (!isset($directory) || !is_string($directory)) {
            throw new InvalidArgumentException("Directory must be a string value");
        }
        $this->directory = $directory;
    }

}