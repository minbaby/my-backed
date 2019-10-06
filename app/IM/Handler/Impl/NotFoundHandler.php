<?php

namespace App\IM\Handler\Impl;

use App\IM\Command\Message;
use App\IM\Handler\AbstractHandler;
use Swoole\Server;
use Swoole\WebSocket\Frame;

class NotFoundHandler extends AbstractHandler
{
    public function handler(Server $server, Frame $frame, Message $message): void
    {
    }
}