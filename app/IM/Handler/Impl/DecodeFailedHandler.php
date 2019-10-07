<?php
//
//
//namespace App\IM\Handler\Impl;
//
//
//use App\IM\Handler\AbstractHandler;
//use App\IM\Command\Message;
//use App\IM\Command\CodeEnum;
//use Swoole\Server;
//use Swoole\WebSocket\Frame;
//
//class DecodeFailedHandler extends AbstractHandler
//{
//    public function handler(Server $server, Frame $frame, Message $message): void
//    {
//
//    }
//
//    public function getOp(): int
//    {
//        return CodeEnum::OP_DECODE_FAILED;
//    }
//}