<?php

namespace App\IM\Packet;

use App\IM\Command\Message;
use App\IM\Handler\CodeEnum;
use Hyperf\Di\Container;
use Psr\Container\ContainerInterface;

class JsonPacket implements PacketIf
{
    /**
     * @var Container
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function pack(Message $operate): string
    {
        return (string) $operate;
    }

    /**
     * @param string $data
     * @return Message
     */
    public function unpack(string $data)
    {
        $data = @json_decode($data, true) ?? [];

        $op = CodeEnum::getOpString(data_get($data, 'op', ''), [CodeEnum::TYPE_MESSAGE]);

        if (empty($data) || $op === '') {
            $op = CodeEnum::getOpString(CodeEnum::OP_DECODE_FAILED,  [CodeEnum::TYPE_MESSAGE]);
        }
        return $this->container->get($op);
    }
}