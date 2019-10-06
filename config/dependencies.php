<?php

declare(strict_types=1);

use App\IM\Command\Impl\Auth\LoginRequest;
use App\IM\Command\Impl\Auth\LoginResponse;
use App\IM\Command\Impl\DecodeFailed;
use App\IM\Command\Impl\HeartBeatMessage;
use App\IM\Command\Impl\Message\MessageData;
use App\IM\Command\Impl\ServerError;
use App\IM\Handler\CodeEnum;
use App\IM\Handler\Impl\DecodeFailedHandler;
use App\IM\Handler\Impl\HeartbeatHandler;
use App\IM\Handler\Impl\ServerErrorHandler;
use App\IM\Handler\Impl\MessageDataHandler;
use App\IM\Packet\JsonPacket;
use App\IM\Packet\PacketIf;

return [
    'dependencies' => [
        PacketIf::class => JsonPacket::class,

        // begin handler
        CodeEnum::getHandlerString(CodeEnum::OP_SERVER_ERROR) => ServerErrorHandler::class,
        CodeEnum::getHandlerString(CodeEnum::OP_DECODE_FAILED) => DecodeFailedHandler::class,
        CodeEnum::getHandlerString(CodeEnum::OP_HEARTBEAT) => HeartbeatHandler::class,
        CodeEnum::getHandlerString(CodeEnum::OP_MESSAGE_DATA) => MessageDataHandler::class,

        // end hander

        //begin message
        CodeEnum::getMessageString(CodeEnum::OP_INIT) => ServerError::class,
        CodeEnum::getMessageString(CodeEnum::OP_SERVER_ERROR) => ServerError::class,
        CodeEnum::getMessageString(CodeEnum::OP_DECODE_FAILED) => DecodeFailed::class,
        CodeEnum::getMessageString(CodeEnum::OP_HEARTBEAT) => HeartBeatMessage::class,
        CodeEnum::getMessageString(CodeEnum::OP_MESSAGE_DATA) => MessageData::class,

        //end message
    ],
];
