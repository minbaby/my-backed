<?php


namespace App\IM\Command\Impl;


use App\IM\Command\Message;
use App\IM\Command\CommandEnum;
use App\IM\Command\StatusEnum;

class ResponseBody
{
    protected $status;

    protected $message;

    protected $data = [];

    protected $op;

    /**
     * @param int $op
     * @param string $status
     * @param string $message
     * @param array $data
     */
    public function __construct(
        int $op,
        string $status = StatusEnum::SUCCESS,
        string $message = '',
        $data = []
    ) {
        $this->op = $op;
        $this->status = $status;
        $this->message = $message;
        $this->data = $data;
    }


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

    /**
     * @param mixed $op
     * @return ResponseBody
     */
    public function setOp($op)
    {
        $this->op = $op;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOp()
    {
        return $this->op;
    }

    public function reset()
    {
    }
}