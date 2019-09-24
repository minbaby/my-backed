<?php


namespace App\IM\Packet;


interface PacketIf
{
    public function pack(array $data): string;

    public function unpack(string $data): array;
}