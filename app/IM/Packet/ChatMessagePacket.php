<?php

namespace App\IM\Packet;

use App\Annotation\PacketAnnotation;
use App\Constants\ChatType;
use App\Constants\CommandEnum;
use App\Constants\MessageDeliveryStatus;
use App\Traits\ArrayableTrait;

/**
 * Class ChatMessage
 * @package App\IM\Packet
 * @PacketAnnotation()
 */
class ChatMessagePacket extends Packet
{
    protected $op = CommandEnum::OP_GET_MESSAGE_REQ;
    /**
     * @var string
     */
    protected $from = '';

    /**
     * @var string
     */
    protected $to = '';

    protected $deliveryStatus = MessageDeliveryStatus::UNKNOWN;

    /**
     * @var int
     */
    protected $chatType = ChatType::UNKNOWN;

    /**
     * @param int $chatType
     * @return self
     */
    public function setChatType(int $chatType): self
    {
        $this->chatType = $chatType;
        return $this;
    }

    /**
     * @return int
     */
    public function getChatType(): int
    {
        return $this->chatType;
    }

    /**
     * @param string $from
     * @return self
     */
    public function setFrom(string $from): self
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @param string $to
     * @return self
     */
    public function setTo(string $to): self
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @return int
     */
    public function getDeliveryStatus(): int
    {
        return $this->deliveryStatus;
    }

    /**
     * @param int $deliveryStatus
     * @return self
     */
    public function setDeliveryStatus(int $deliveryStatus): self
    {
        $this->deliveryStatus = $deliveryStatus;

        return $this;
    }
}