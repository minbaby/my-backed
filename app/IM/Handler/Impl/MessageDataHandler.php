<?php


namespace App\IM\Handler\Impl;


use App\IM\Command\Impl\ResponseBody;
use App\IM\Command\Message;
use App\IM\Handler\AbstractHandler;
use App\IM\Handler\CodeEnum;
use Swoole\Server;
use Swoole\WebSocket\Frame;

class MessageDataHandler extends AbstractHandler
{

    /**
     * @param Server $server
     * @param Frame $frame
     * @param Message $message
     */
    public function handler(Server $server, Frame $frame, Message $message): void
    {
        $this->push($server, $frame, (new ResponseBody())->setStatus(CodeEnum::STATUS_SUCCESS));
    }
}