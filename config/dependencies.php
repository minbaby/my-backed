<?php

declare(strict_types=1);

use App\IM\Handler\CodeEnum;
use App\IM\Handler\Impl\NotFoundHandler;
use App\IM\Packet\JsonPacket;
use App\IM\Packet\PacketIf;

return [
    'dependencies' => [
        PacketIf::class => JsonPacket::class,
        CodeEnum::OP_NOT_FOUND => NotFoundHandler::class,
    ],
];
