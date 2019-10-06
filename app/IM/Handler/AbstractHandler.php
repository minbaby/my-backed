<?php

namespace App\IM\Handler;

use App\IM\Command\Message;
use App\IM\Packet\PacketIf;
use App\Utils\LogUtils;
use Hyperf\Logger\LoggerFactory;
use Psr\Container\ContainerInterface;
use Swoole\Server;
use Swoole\WebSocket\Frame;

abstract class AbstractHandler implements HandlerIf
{
    protected const OP_CODE = -1;
    /**
     * @var LoggerFactory
     */
    protected $logger;

    /**
     * @var PacketIf
     */
    protected $packet;
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * AbstractHandler constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->logger = LogUtils::get(static::class);
        $this->packet = $this->container->get(PacketIf::class);
    }

    /**
     * @param Server $server
     * @param Frame $frame
     * @param Message $operate
     */
    protected function push(Server $server, Frame $frame, Message $operate)
    {
        $server->push($frame->fd, $this->packet->pack($operate));
    }
}