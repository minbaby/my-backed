<?php

namespace App\IM\Packet;

class JsonPacket implements PacketIf
{

    public function pack(array $data): string
    {
        return json_encode($data);
    }

    public function unpack(string $data): array
    {
        return @json_decode($data, true) ?? [];
    }
}