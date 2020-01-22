<?php

namespace App\IM\Pack;

use App\IM\Packet\Message;
use App\Constants\CommandEnum;
use App\IM\Packet\Packet;
use App\Utils\HandlerUtils;
use App\Utils\LogUtils;
use App\Utils\PacketUtils;
use Hyperf\Di\Container;
use Hyperf\Logger\Logger;
use Hyperf\Utils\Contracts\Arrayable;
use Hyperf\Utils\Str;
use Psr\Container\ContainerInterface;

class JsonPack implements PackIf
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @var Logger
     */
    protected $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->logger = LogUtils::get(__CLASS__);
    }


    public function pack(Arrayable $operate): string
    {
        return json_encode($operate->toArray());
    }

    /**
     * @param string $data
     * @return Packet
     */
    public function unpack(string $data)
    {
        $data = @json_decode($data, true) ?? [];

        $op = data_get($data, 'op', CommandEnum::OP_DECODE_FAILED);

        $packetClass = PacketUtils::get($op, PacketUtils::get(CommandEnum::OP_DECODE_FAILED));

        $obj = $this->container->get($packetClass);

        if (is_array($data)) {
            $obj = $this->assign($data, $obj);
        }

        return $obj;
    }

    /**
     * @param array $data
     * @param object $obj
     * @return Packet
     */
    private function assign(array $data, Packet $obj)
    {
        foreach ($data as $key => $value) {
            $method = setter($key);
            if (!method_exists($obj, $method)) {
                $this->logger->debug(__METHOD__, ['no method', $key, $value]);
                continue;
            }
            $obj->{$method}($value);
        }

        return $obj;
    }
}