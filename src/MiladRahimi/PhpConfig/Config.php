<?php

namespace MiladRahimi\PhpConfig;

use MiladRahimi\PhpConfig\Repositories\Repository;

class Config
{
    /**
     * Configuration repository
     *
     * @var Repository
     */
    private $repository;

    /**
     * Config constructor.
     *
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Set configuration
     *
     * @param string $name
     * @param mixed $value
     */
    public function set(string $name, $value)
    {
        $data = $this->repository->getData();

        $keys = explode('.', $name);

        while (count($keys) > 1) {
            $key = array_shift($keys);

            if (isset($data[$key]) == false || is_array($data[$key]) == false) {
                $data[$key] = [];
            }

            $data = &$data[$key];
        }

        $array[array_shift($keys)] = $value;
    }

    /**
     * Get configuration
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get(string $name, $default = null)
    {
        $data = $this->repository->getData();

        if (strpos($name, '.') === false) {
            return $data[$name] ?? $default;
        }

        foreach (explode('.', $name) as $segment) {
            if (array_key_exists($segment, $data)) {
                $data = $data[$segment];
            } else {
                return $default;
            }
        }

        return $data;
    }

    /**
     * Check if the configuration is set
     *
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        $data = $this->repository->getData();

        if (strpos($name, '.') === false) {
            return isset($data[$name]);
        }

        foreach (explode('.', $name) as $segment) {
            if (array_key_exists($segment, $data)) {
                $data = $data[$segment];
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * @return Repository
     */
    public function getRepository(): Repository
    {
        return $this->repository;
    }
}