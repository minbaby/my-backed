<?php
declare(strict_types=1);

namespace App\Controller;

use App\IM\Handler\HandlerIf;
use App\IM\Packet\PacketIf;
use App\Utils\LogUtils;
use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Utils\Arr;
use Hyperf\Utils\Str;
use Hyperf\Utils\Traits\StaticInstance;
use Psr\Container\ContainerInterface;
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

        $data = $this->packet->unpack($frame->data);

        /** @var HandlerIf $handler */
        $handler = $this->handlerFactory->create($data ?? []);

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

class HandlerFactory
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * HandlerFactory constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function create(array $json)
    {
        LogUtils::get(__CLASS__)->info('x', $json);
        $name = $this->getDiName('not_supported');
        if ($json == null || !isset($json['op'])) {
            return $this->container->get($name);
        }

        $opName = $this->getDiName($json['op']);

        if ($this->container->has($opName)) {
            $name = $opName;
        }

        LogUtils::get(__CLASS__)->info('op exec ' . $name);

        return $this->container->get($name);
    }

    /**
     * @param string $op
     * @return string
     */
    protected function getDiName(string $op): string
    {
        LogUtils::get(__CLASS__)->info('op ' . $op);
        return sprintf("\\App\\IM\\Handler\\Impl\\%sHandler", Str::studly($op));
    }
}