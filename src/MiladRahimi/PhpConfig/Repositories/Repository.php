<?php

namespace MiladRahimi\PhpConfig\Repositories;

interface Repository
{
    /**
     * Get configuration data
     *
     * @return array
     */
    public function getData(): array;
}