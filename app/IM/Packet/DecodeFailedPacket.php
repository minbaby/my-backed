<?php

namespace App\IM\Packet;

use App\Annotation\PacketAnnotation;
use App\Constants\CommandEnum;

/**
 * Class DecodeFailed
 * @PacketAnnotation()
 */
class DecodeFailedPacket extends Packet
{
    protected $op = CommandEnum::OP_DECODE_FAILED;
}