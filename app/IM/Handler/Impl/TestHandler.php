<?php
//
//
//namespace App\IM\Handler\Impl;
//
//
//use App\IM\Command\Impl\HeartBeatMessage;
//use App\IM\Handler\AbstractHandler;
//use App\IM\Command\Message;
//use App\IM\Command\CodeEnum;
//use Swoole\Server;
//use Swoole\WebSocket\Frame;
//
//class TestHandler extends AbstractHandler
//{
//
//    /**
//     * @param Server $server
//     * @param Frame $frame
//     * @param HeartBeatMessage|Message $message
//     */
//    public function handler(Server $server, Frame $frame, Message $message): void
//    {
//        $this->logger->info(__METHOD__, [$message->toArray()]);
//    }
//    public function getOp(): int
//    {
//        return CodeEnum::OP_INIT;
//    }
//}