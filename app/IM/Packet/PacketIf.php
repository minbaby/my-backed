<?php


namespace App\IM\Packet;


use App\IM\Handler\Operate;

interface PacketIf
{
    public function pack(Operate $operate): string;

    public function unpack(string $data): Operate;
}