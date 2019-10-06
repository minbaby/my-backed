<?php

namespace App\IM\Handler\Impl;

use App\IM\Command\Message;
use App\IM\Handler\AbstractHandler;
use Swoole\Server;
use Swoole\WebSocket\Frame;

class LoginHandler extends AbstractHandler
{
    protected const OP_CODE = 1;

    /**
     * @param Server $server
     * @param Frame $frame
     * @param Message $message
     */
    public function handler(Server $server, Frame $frame, Message $message): void
    {
    }
}