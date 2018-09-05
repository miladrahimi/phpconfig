<?php
/**
 * Created by PhpStorm.
 * User: Milad Rahimi <milad.rahimi@snapp.cab>
 * Date: 9/5/2018 AD
 * Time: 14:06
 */

namespace MiladRahimi\PhpConfig;

class Config
{
    /**
     * Configuration data
     *
     * @var array
     */
    private $data = [];

    /**
     * Config constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    /**
     * Set
     *
     * @param string $name
     * @param mixed $value
     */
    public function set(string $name, $value)
    {
        $data = $this->data;

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
     * Get
     *
     * @param string $name
     * @param mixed $default
     * @return mixed
     */
    public function get(string $name, $default)
    {
        if (strpos($name, '.') === false) {
            return $this->data[$name] ?? $default;
        }

        $data = $this->data;

        foreach (explode('.', $name) as $segment) {
            if (array_key_exists($segment, $data)) {
                $data = $data[$segment];
            } else {
                return $default;
            }
        }

        return $data;
    }
}