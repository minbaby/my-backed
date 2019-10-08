<?php


namespace App\IM\Command\Impl\Message;


use App\Annotation\IMMessage;
use App\IM\Command\ChatType;
use App\IM\Command\Message;
use App\IM\Command\CommandEnum;

/**
 * Class MessageData
 * @package App\IM\Command\Impl\Message
 * @IMMessage()
 */
class MessageData extends Message
{
    protected $op = CommandEnum::OP_MESSAGE_DATA;

    /**
     * @var string
     */
    protected $from = '';

    /**
     * @var string
     */
    protected $to = '';

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var int
     */
    protected $chatType = ChatType::UNKNOW;

    /**
     * @param string $from
     * @return MessageData
     */
    public function setFrom(string $from)
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
     * @return MessageData
     */
    public function setTo(string $to)
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
     * @param array $data
     * @return MessageData
     */
    public function setData(array $data): MessageData
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param int $chatType
     * @return MessageData
     */
    public function setChatType(int $chatType): MessageData
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
}