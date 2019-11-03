<?php

namespace App\IM\Command;

use Carbon\Carbon;
use Hyperf\Utils\Contracts\Arrayable;
use Hyperf\Utils\Contracts\Jsonable;

abstract class Message implements Jsonable, Arrayable
{
    /**
     * @var int
     */
    protected $op = CommandEnum::OP_UNKNOW;

    /**
     * @var string
     */
    protected $createTime;

    /**
     * @var int
     */
    protected $id = 0;

    /**
     * @var array 
     */
    protected $ignore = [];

    /**
     * @var array
     */
    protected $extras = [];

    public function __construct()
    {
        $this->id = $this->createTime = Carbon::now()->valueOf();
    }

    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    public function toArray(): array
    {
        $ret = [];
        $map = get_object_vars($this);
        foreach ($map as $key => $value) {
            if (in_array($key, $this->ignore)) {
                continue;
            }
            $ret[$key] =$value;
        }

        return $ret;
    }

    /**
     * @return int
     */
    public function getOp(): int
    {
        return $this->op;
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
     * @param string $key
     * @param $values
     * @return $this
     */
    public function addExtras(string $key, $values)
    {
        $this->extras[$key] = $values;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreateTime(): string
    {
        return $this->createTime;
    }

    /**
     * @param string $createTime
     * @return Message
     */
    public function setCreateTime(string $createTime): Message
    {
        $this->createTime = $createTime;
        return $this;
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
}