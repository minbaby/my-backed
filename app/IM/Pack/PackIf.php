<?php


namespace App\IM\Pack;



use App\IM\Packet\Packet;
use Hyperf\Utils\Contracts\Arrayable;

interface PackIf
{
    public function pack(Arrayable $operate): string;

    /**
     * @param string $data
     * @return Packet
     */
    public function unpack(string $data);
}