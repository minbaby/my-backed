<?php
//
//
//namespace App\IM\Handler\Impl;
//
//
//use App\IM\Command\Message;
//use App\IM\Handler\AbstractHandler;
//use App\IM\Command\CodeEnum;
//use Swoole\Server;
//use Swoole\WebSocket\Frame;
//
//class HeartbeatHandler extends AbstractHandler
//{
//
//    /**
//     * @param Server $server
//     * @param Frame $frame
//     * @param Message $message
//     */
//    public function handler(Server $server, Frame $frame, Message $message): void
//    {
//        // TODO: Implement handler() method.
//    }
//    public function getOp(): int
//    {
//        return CodeEnum::OP_HEARTBEAT;
//    }
//}