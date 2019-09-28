<?php

namespace App\IM\Handler\Impl;

use App\IM\Handler\AbstractHandler;
use App\IM\Handler\CodeEnum;
use Swoole\Server;
use Swoole\WebSocket\Frame;

class NotFoundHandler extends AbstractHandler
{
    public function handler(Server $server, Frame $frame, $decodeData)
    {
        $server->push($frame->fd, $this->packet->pack(['op' => CodeEnum::OP_NOT_FOUND]));
        $this->push($server, $frame, []);
    }
}