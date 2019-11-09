<?php

namespace App\IM\Packet;

use App\Annotation\PacketAnnotation;
use App\Constants\CommandEnum;

/**
 * @PacketAnnotation()
 */
class HeartBeatPacket extends Packet
{
    protected $ignore = ['body'];

    protected $op = CommandEnum::OP_HEARTBEAT;
}