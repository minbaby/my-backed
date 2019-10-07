<?php
//
//namespace App\IM\Handler\Impl;
//
//use App\IM\Command\Message;
//use App\IM\Handler\AbstractHandler;
//use App\IM\Command\CodeEnum;
//use Swoole\Server;
//use Swoole\WebSocket\Frame;
//
//class LoginHandler extends AbstractHandler
//{
//    protected const OP_CODE = 1;
//
//    /**
//     * @param Server $server
//     * @param Frame $frame
//     * @param Message $message
//     */
//    public function handler(Server $server, Frame $frame, Message $message): void
//    {
//    }
//
//    public function getOp(): int
//    {
//        return CodeEnum::OP_AUTH_LOGIN_REQ;
//    }
//}