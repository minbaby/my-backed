<?php


namespace App\IM\Handler\Impl;


use App\IM\Handler\AbstractHandler;
use App\IM\Handler\CodeEnum;
use App\IM\Handler\Operate;
use Swoole\Server;
use Swoole\WebSocket\Frame;

class DecodeFailedHandler extends AbstractHandler
{
    public function handler(Server $server, Frame $frame, Operate $operate)
    {
        $this->push($server, $frame, new Operate(
            CodeEnum::OP_DECODE_FAILED
        ));
    }
}