<?php

namespace App\Traits;

trait ArrayableTrait
{
    /**
     * @var array
     */
    protected $defaultIgnore = ['ignore', 'defaultIgnore'];

    protected $ignore = [];

    public function toArray(): array
    {
        $ret = [];
        $map = get_object_vars($this);
        foreach ($map as $key => $_) {
            if (in_array($key, $this->getIgnore())) {
                continue;
            }

            $ret[$key] = call([$this, getter($key)]);
        }

        return $ret;
    }

    protected function getIgnore()
    {
        return array_merge($this->defaultIgnore, $this->ignore);
    }
}