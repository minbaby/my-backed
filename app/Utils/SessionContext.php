<?php

namespace App\Utils;

use Swoole\Server;
use Swoole\WebSocket\Frame;

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

    public function fromServer(Server $server)
    {
        return $this->set('port', $server->port)
            ->set('host', $server->host);
    }

    public function fromFrame(Frame $frame)
    {
        return $this->set('frame', $frame);
    }
}