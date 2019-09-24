<?php

namespace App\IM\Handler\Impl;

use App\IM\Handler\AbstractHandler;
use Swoole\Server;
use Swoole\WebSocket\Frame;

class NotSupportedHandler extends AbstractHandler
{
    public function handler(Server $server, Frame $frame, $decodeData)
    {
        $server->push($frame->fd, $this->packet->pack(['op' => 'not_supported']));
        $this->push($server, $frame, []);
    }
}