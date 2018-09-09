<?php

namespace MiladRahimi\PhpConfig\Repositories;

use MiladRahimi\PhpConfig\Exceptions\InvalidConfigDirectoryException;
use MiladRahimi\PhpConfig\Exceptions\InvalidConfigFileException;

class DirectoryRepository implements Repository
{
    /**
     * Configuration data
     *
     * @var array
     */
    private $data;

    /**
     * DirectoryRepository constructor.
     *
     * @param string $directoryPath
     * @param bool $strict
     * @throws InvalidConfigDirectoryException
     * @throws InvalidConfigFileException
     */
    public function __construct(string $directoryPath, bool $strict = false)
    {
        if (file_exists($directoryPath) == false) {
            throw new InvalidConfigDirectoryException();
        }

        $files = scandir($directoryPath);

        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            $data = require $directoryPath . '/' . $file;

            if (is_array($data) == false) {
                if ($strict) {
                    throw new InvalidConfigFileException('Config file content must be a PHP array.');
                }

                continue;
            }

            $this->data[pathinfo($file, PATHINFO_FILENAME)] = $data;
        }
    }

    /**
     * Get configuration data
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}