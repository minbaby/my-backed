<?php

namespace App\IM\Command;

use Hyperf\Utils\Contracts\Arrayable;
use Hyperf\Utils\Contracts\Jsonable;

abstract class Message implements Jsonable, Arrayable
{
    /**
     * @var int
     */
    protected $op;

    /**
     * @var \DateTime
     */
    protected $createTime;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var array
     */
    protected $extras = [];

    public function __construct()
    {
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    public function toArray(): array
    {
        return [
            'op' => $this->op,
        ];
    }

    /**
     * @return int
     */
    public function getOp(): int
    {
        return $this->op;
    }

    /**
     * @param int $op
     * @return Message
     */
    public function setOp(int $op): Message
    {
        $this->op = $op;
        return $this;
    }

    /**
     * @return array
     */
    public function getExtras(): array
    {
        return $this->extras;
    }

    /**
     * @param array $extras
     * @return Message
     */
    public function setExtras(array $extras): Message
    {
        $this->extras = $extras;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreateTime(): \DateTime
    {
        return $this->createTime;
    }

    /**
     * @param \DateTime $createTime
     * @return Message
     */
    public function setCreateTime(\DateTime $createTime): Message
    {
        $this->createTime = $createTime;
        return $this;
    }
}