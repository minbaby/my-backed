<?php


namespace App\IM\Packet;



use App\IM\Command\Message;

interface PacketIf
{
    public function pack(Message $operate): string;

    /**
     * @param string $data
     * @return Message
     */
    public function unpack(string $data);
}