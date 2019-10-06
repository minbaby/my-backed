<?php


namespace App\IM\Command\Impl\Message;


use App\IM\Command\Message;
use App\IM\Handler\CodeEnum;

class MessageData extends Message
{
    protected $op = CodeEnum::OP_MESSAGE_DATA;

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
}