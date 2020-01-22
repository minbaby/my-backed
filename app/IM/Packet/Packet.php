<?php

namespace App\IM\Packet;

use App\Traits\ArrayableTrait;
use Hyperf\Utils\Contracts\Arrayable;

abstract class Packet implements Arrayable
{
    use ArrayableTrait;

    protected $id;

    /**
     * @var int
     */
    protected $op;

    /**
     * @param int $op
     * @return Packet
     */
    public function setOp(int $op)
    {
        $this->op = $op;
        return $this;
    }

    /**
     * @return int
     */
    public function getOp(): int
    {
        return $this->op;
    }

    /**
     * @param mixed $id
     * @return Packet
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}