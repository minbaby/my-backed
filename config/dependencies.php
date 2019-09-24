<?php

declare(strict_types=1);

use App\IM\Packet\JsonPacket;
use App\IM\Packet\PacketIf;

return [
    'dependencies' => [
        PacketIf::class => JsonPacket::class
    ],
];
