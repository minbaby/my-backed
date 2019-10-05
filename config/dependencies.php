<?php

declare(strict_types=1);

use App\IM\Handler\CodeEnum;
use App\IM\Handler\Impl\DecodeFailedHandler;
use App\IM\Handler\Impl\NoPermissionHandler;
use App\IM\Handler\Impl\NotFoundHandler;
use App\IM\Handler\Impl\ServerErrorHandler;
use App\IM\Packet\JsonPacket;
use App\IM\Packet\PacketIf;

return [
    'dependencies' => array(
        PacketIf::class => JsonPacket::class,
        CodeEnum::getOpString(CodeEnum::OP_SERVER_ERROR) => ServerErrorHandler::class,
        CodeEnum::getOpString(CodeEnum::OP_NOT_FOUND) => NotFoundHandler::class,
        CodeEnum::getOpString(CodeEnum::OP_NO_PERMISSION) => NoPermissionHandler::class,
        CodeEnum::getOpString(CodeEnum::OP_DECODE_FAILED) => DecodeFailedHandler::class,
    ),
];
