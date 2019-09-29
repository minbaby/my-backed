<?php
declare(strict_types=1);

namespace App\Controller;

use App\IM\Handler\HandlerIf;
use App\IM\Handler\Operate;
use App\IM\HandlerFactory;
use App\IM\Packet\PacketIf;
use App\Utils\LogUtils;
use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Swoole\Http\Request;
use Swoole\Server;
use Swoole\Websocket\Frame;

/**
 * Class WebSocketController
 * @package App\Controller
 */
class WebSocketController implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{
    /**
     * @var EventDispatcherInterface
     * @Inject()
     */
    protected $eventDispatcher;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var PacketIf
     * @Inject()
     */
    protected $packet;

    /**
     * @var HandlerFactory
     * @Inject()
     */
    protected $handlerFactory;

    public function __construct()
    {
        $this->logger = LogUtils::get(__CLASS__);
    }

    public function onMessage(Server $server, Frame $frame): void
    {
        $this->logger->info(__METHOD__, [$frame->data, $frame->fd]);

        /** @var Operate $data */
        $data = $this->packet->unpack($frame->data);

        /** @var HandlerIf $handler */
        $handler = $this->handlerFactory->create($data);

        $this->logger->info(__METHOD__, ['op event created']);

        $handler->handler($server, $frame, $data);
    }

    public function onClose(Server $server, int $fd, int $reactorId): void
    {
        $this->logger->info(__METHOD__, [$fd, $reactorId]);
    }

    public function onOpen(Server $server, Request $request): void
    {
        $this->logger->info(__METHOD__, [$request->fd]);
    }
}