<?php

namespace MiladRahimi\PhpConfig\Repositories;

class ArrayRepository implements Repository
{
    /**
     * Configuration data
     *
     * @var array
     */
    private $data;

    /**
     * ArrayRepository constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
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