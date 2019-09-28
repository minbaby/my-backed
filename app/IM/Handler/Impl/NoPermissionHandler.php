<?php


namespace App\IM\Handler\Impl;

use App\IM\Handler\AbstractHandler;
use Swoole\Server;
use Swoole\WebSocket\Frame;

class NoPermissionHandler extends AbstractHandler
{
    public function handler(Server $server, Frame $frame, $decodeData)
    {
        $this->push($server, $frame, ['op' => 'no_permission']);
    }
}