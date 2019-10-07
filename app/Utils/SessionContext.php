<?php

namespace App\Utils;

class SessionContext
{

    protected $container = [];

    public function set(string $id, $value)
    {
        $this->container[$id] = $value;
        return $this;
    }

    public function get(string $id, $default = null)
    {
        return $this->container[$id] ?? $default;
    }

    public function has(string $id)
    {
        return isset($this->container[$id]);
    }
}