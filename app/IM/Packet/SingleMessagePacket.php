<?php

namespace App\IM\Packet;


use App\Annotation\PacketAnnotation;
use App\Constants\CommandEnum;

/**
 * Class SingleMessagePacket
 * @package App\IM\Packet
 * @PacketAnnotation()
 */
class SingleMessagePacket extends Packet
{
    protected $op = CommandEnum::OP_SINGLE_MESSAGE;

    protected $from;

    protected $to;

    protected $message;

    /**
     * @param mixed $from
     * @return SingleMessagePacket
     */
    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $to
     * @return SingleMessagePacket
     */
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $message
     * @return SingleMessagePacket
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }
}