<?php

namespace App\IM\Handler\Impl;

use App\IM\Handler\AbstractHandler;
use App\IM\Handler\Operate;
use Swoole\Server;
use Swoole\WebSocket\Frame;

class LoginHandler extends AbstractHandler
{
    protected const OP_CODE = 1;

    public function handler(Server $server, Frame $frame, Operate $operate)
    {
    }
}