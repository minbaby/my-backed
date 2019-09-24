<?php

namespace App\IM\Handler\Impl;

use App\IM\Handler\AbstractHandler;
use Swoole\Server;
use Swoole\WebSocket\Frame;

class LoginHandler extends AbstractHandler
{
    protected const OP_CODE = 1;

    public function handler(Server $server, Frame $frame, $decodeData)
    {
        $server->push($frame->fd, $this->packet->pack(['op' => 'not_supported']));
    }
}