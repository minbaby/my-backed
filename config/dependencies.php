<?php

declare(strict_types=1);

use App\IM\Handler\CodeEnum;
use App\IM\Packet\JsonPacket;
use App\IM\Packet\PacketIf;

return [
    'dependencies' => [
        PacketIf::class => JsonPacket::class,

        // begin handler
        CodeEnum::getHandlerString(CodeEnum::OP_SERVER_ERROR) => App\IM\Handler\Impl\ServerErrorHandler::class,
        CodeEnum::getHandlerString(CodeEnum::OP_NOT_FOUND) => App\IM\Handler\Impl\NotFoundHandler::class,
        CodeEnum::getHandlerString(CodeEnum::OP_NO_PERMISSION) => App\IM\Handler\Impl\NoPermissionHandler::class,
        CodeEnum::getHandlerString(CodeEnum::OP_DECODE_FAILED) => App\IM\Handler\Impl\DecodeFailedHandler::class,
        CodeEnum::getHandlerString(CodeEnum::OP_HEARTBEAT) => App\IM\Handler\Impl\HeartbeatHandler::class,
        // end hander

        //begin message
        CodeEnum::getMessageString(CodeEnum::OP_HEARTBEAT) => \App\IM\Command\Impl\HeartBeatMessage::class
        //end message
    ],
];
