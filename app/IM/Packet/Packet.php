<?php

namespace App\IM\Packet;

use App\Traits\ArrayableTrait;
use Hyperf\Utils\Arr;
use Hyperf\Utils\Contracts\Arrayable;

class Packet implements Arrayable
{
    use ArrayableTrait;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var int
     */
    protected $op;

    const DEFAULT_VERSION = 'v1';

    /**
     * @var array|null
     */
    protected $body;

    /**
     * @param array|null|Arrayable $body
     * @return Packet
     */
    public function setBody($body): Packet
    {
        if (Arr::accessible($body)) {
            $this->body = (array) $body;
        }

        if ($body instanceof Arrayable) {
            $this->body = $body->toArray();
        }

        return $this;
    }

    /**
     * @return array|null
     */
    public function getBody(): ?array
    {
        return $this->body;
    }

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
     * @param string $version
     * @return Packet
     */
    public function setVersion(string $version): Packet
    {
        $this->version = $version;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version ?? self::DEFAULT_VERSION;
    }
}