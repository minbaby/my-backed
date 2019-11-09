<?php

namespace App\IM\Packet;

use App\Annotation\PacketAnnotation;
use App\Constants\CommandEnum;

/**
 * Class UnKonwn
 * @package App\IM\Command\Impl
 * @PacketAnnotation()
 */
class UnknownPacket extends Packet
{
    protected $ignore = ['body'];

    protected $op =  CommandEnum::OP_UNKNOWN;
}