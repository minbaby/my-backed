<?php


namespace App\IM\Handler;


use App\IM\Command\Message;
use Swoole\Server;
use Swoole\WebSocket\Frame;

interface HandlerIf
{
    /**
     * @param Server $server
     * @param Frame $frame
     * @param Message $message
     */
    public function handler(Server $server, Frame $frame, Message $message): void;
}