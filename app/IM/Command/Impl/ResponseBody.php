<?php


namespace App\IM\Command\Impl;


use App\IM\Command\Message;
use App\IM\Handler\CodeEnum;

class ResponseBody extends Message
{
    protected $status = CodeEnum::STATUS_SUCCESS;

    protected $message = '';

    protected $data = [];

    /**
     * @param int $status
     * @return ResponseBody
     */
    public function setStatus(int $status): ResponseBody
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param string $message
     * @return ResponseBody
     */
    public function setMessage(string $message): ResponseBody
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param array $data
     * @return ResponseBody
     */
    public function setData(array $data): ResponseBody
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}