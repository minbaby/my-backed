<?php


namespace App\IM\Packet;


use App\Annotation\PacketAnnotation;
use App\Constants\ChatType;
use App\Constants\CommandEnum;

/**
 * Class MessageData
 * @PacketAnnotation()
 */
class MessageData extends Packet
{
    protected $op = CommandEnum::OP_GET_MESSAGE_REQ;
}