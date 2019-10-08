<?php

declare(strict_types=1);

use App\IM\Packet\JsonPacket;
use App\IM\Packet\PacketIf;

return [
    PacketIf::class => JsonPacket::class,
];
