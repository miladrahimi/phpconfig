<?php

namespace MiladRahimi\PhpConfig\Repositories;

use MiladRahimi\PhpConfig\Exceptions\InvalidConfigDirectoryException;
use MiladRahimi\PhpConfig\Exceptions\InvalidConfigFileException;

class JsonDirectoryRepository implements Repository
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
     * @param string $jsonDirectoryPath
     * @param bool $strict
     * @throws InvalidConfigDirectoryException
     * @throws InvalidConfigFileException
     */
    public function __construct(string $jsonDirectoryPath, bool $strict = false)
    {
        if (file_exists($jsonDirectoryPath) == false) {
            throw new InvalidConfigDirectoryException();
        }

        $files = scandir($jsonDirectoryPath);

        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            $data = json_decode(file_get_contents($jsonDirectoryPath . '/' . $file), true);

            if (is_array($data) == false) {
                if ($strict) {
                    throw new InvalidConfigFileException('Config file content must be a valid json.');
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