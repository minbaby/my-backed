<?php

namespace App\IM\Packet;

use App\IM\Handler\CodeEnum;
use App\IM\Handler\Operate;

class JsonPacket implements PacketIf
{
    public function pack(Operate $operate): string
    {
        return (string) $operate;
    }

    public function unpack(string $data): Operate
    {
        $data = @json_decode($data, true) ?? [];

        if (empty($data)) {
            return new Operate(CodeEnum::OP_DECODE_FAILED);
        } else {
            return new Operate(
                data_get($data, 'op'),
                data_get($data, 'message'),
                data_get($data, 'data')
            );
        }
    }
}