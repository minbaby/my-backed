<?php

namespace App\IM\Packet;

use App\IM\Command\Message;
use App\IM\Handler\CodeEnum;
use App\Utils\LogUtils;
use Hyperf\Di\Container;
use Hyperf\Logger\Logger;
use Psr\Container\ContainerInterface;

class JsonPacket implements PacketIf
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


    public function pack(Message $operate): string
    {
        return (string)$operate;
    }

    /**
     * @param string $data
     * @return Message
     */
    public function unpack(string $data)
    {
        $data = @json_decode($data, true) ?? [];

        $op = CodeEnum::getMessageString(data_get($data, 'op', ''));

        if (empty($data) || $op === '') {
            $op = CodeEnum::getMessageString(CodeEnum::OP_DECODE_FAILED);
        }
        $obj = $this->container->get($op);
        return $this->assign($data, $obj);
    }

    private function assign(array $data, object $obj)
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