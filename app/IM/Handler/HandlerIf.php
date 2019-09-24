<?php


namespace App\IM\Handler;


use Swoole\Server;
use Swoole\WebSocket\Frame;

interface HandlerIf
{
    public function handler(Server $server, Frame $frame, $decodeData);
}