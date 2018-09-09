<?php

namespace MiladRahimi\PhpConfig\Repositories;

use MiladRahimi\PhpConfig\Exceptions\InvalidConfigFileException;

class JsonFileRepository implements Repository
{
    /**
     * Configuration data
     *
     * @var array
     */
    private $data;

    /**
     * JsonFileRepository constructor.
     *
     * @param string $jsonFilePath
     * @throws InvalidConfigFileException
     */
    public function __construct(string $jsonFilePath)
    {
        if (file_exists($jsonFilePath) == false) {
            throw new InvalidConfigFileException('Config file not found.');
        }

        $this->data = json_decode(file_get_contents($jsonFilePath), true);

        if (is_array($this->data) == false) {
            throw new InvalidConfigFileException('Config file content must be a valid json.');
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