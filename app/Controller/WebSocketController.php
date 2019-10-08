<?php
declare(strict_types=1);

namespace App\Controller;

use App\IM\Command\CommandEnum;
use App\IM\Handler\HandlerIf;
use App\IM\Packet\PacketIf;
use App\Utils\HandlerUtils;
use App\Utils\LogUtils;
use App\Utils\SessionContext;
use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Hyperf\Di\Annotation\Inject;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Swoole\Http\Request;
use Swoole\Server;
use Swoole\Websocket\Frame;
use Swoole\WebSocket\Server as WsServer;

/**
 * Class WebSocketController
 * @package App\Controller
 */
class WebSocketController implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{
    /**
     * 10s
     */
    const HEARTBEAT = 3000;

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
     * @var ContainerInterface
     * @Inject()
     */
    protected $container;

    public function __construct()
    {
        $this->logger = LogUtils::get(__CLASS__);
    }

    public function onMessage(WsServer $server, Frame $frame): void
    {
        $this->logger->info(__METHOD__, [$frame->data, $frame->fd]);

        if (!$frame->finish) {
            $this->logger->debug("not finish");
            return;
        }

        $inMessage = $this->packet->unpack($frame->data);

        $context = new SessionContext();

        $context->fromFrame($frame)->fromServer($server);


        $handlerClass = HandlerUtils::get((string) $inMessage->getOp(), '');

        if (!$this->container->has($handlerClass)) {
            $handlerClass = HandlerUtils::get((string) CommandEnum::OP_UNKNOW);
        }

        /** @var HandlerIf $handler */
        $handler = $this->container->get($handlerClass);
        $outMessage = $handler->handler($inMessage, $context);

        if ($outMessage) {
            $server->push($frame->fd, $this->packet->pack($outMessage));
        }

        unset($context);
    }

    public function onClose(Server $server, int $fd, int $reactorId): void
    {
        $this->logger->info(__METHOD__, [$fd, $reactorId]);
    }

    public function onOpen(WsServer $server, Request $request): void
    {
        $this->logger->info(__METHOD__, [$request->fd]);
    }
}