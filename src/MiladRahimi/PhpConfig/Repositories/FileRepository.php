<?php

namespace MiladRahimi\PhpConfig\Repositories;

use MiladRahimi\PhpConfig\Exceptions\InvalidConfigFileException;

class FileRepository implements Repository
{
    /**
     * Configuration data
     *
     * @var array
     */
    private $data;

    /**
     * FileDriver constructor.
     *
     * @param string $filePath
     * @throws InvalidConfigFileException
     */
    public function __construct(string $filePath)
    {
        if (file_exists($filePath) == false) {
            throw new InvalidConfigFileException('Config file not found.');
        }

        $this->data = require $filePath;

        if (is_array($this->data) == false) {
            throw new InvalidConfigFileException('Config file content must be a PHP array.');
        }
    }

    /**
     * @inheritdoc
     */
    public function getData(): array
    {
        return $this->data;
    }
}