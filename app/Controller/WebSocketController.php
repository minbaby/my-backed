<?php
declare(strict_types=1);

namespace App\Controller;

use App\IM\Command\Impl\HeartBeatMessage;
use App\IM\Packet\PacketIf;
use App\Utils\HandlerUtils;
use App\Utils\LogUtils;
use App\Utils\SessionContext;
use Carbon\Carbon;
use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Hyperf\Di\Annotation\Inject;
use Psr\Log\LoggerInterface;
use Swoole\Http\Request;
use Swoole\Server;
use Swoole\Timer;
use Swoole\Websocket\Frame;

/**
 * Class WebSocketController
 * @package App\Controller
 */
class WebSocketController implements OnMessageInterface, OnOpenInterface, OnCloseInterface
{
    /**
     * 10s
     */
    const HEARTBEAT = 10000;

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
     * @var int[]
     */
    protected $timers;

    public function __construct()
    {
        $this->logger = LogUtils::get(__CLASS__);
    }

    public function onMessage(Server $server, Frame $frame): void
    {
        $this->logger->info(__METHOD__, [$frame->data, $frame->fd]);

        if (!$frame->finish) {
            $this->logger->debug("not finish");
            return;
        }

        $inMessage = $this->packet->unpack($frame->data);

        $context = new SessionContext();

        $context->set('frame', $frame)
            ->set('port', $server->port)
            ->set('host', $server->host);

        $outMessage = HandlerUtils::get((string) $inMessage->getOp())->handler($inMessage, $context);

        $server->push($frame->fd, $this->packet->pack($outMessage));

        unset($context);
    }

    public function onClose(Server $server, int $fd, int $reactorId): void
    {
        $this->logger->info(__METHOD__, [$fd, $reactorId]);
        Timer::clear($this->timers[$fd]);
    }

    public function onOpen(Server $server, Request $request): void
    {
        $this->logger->info(__METHOD__, [$request->fd]);
        $this->timers[$request->fd] = Timer::tick(static::HEARTBEAT, function ()  use ($server, $request) {
            $this->logger->info("trigger heartbeat", [$request->fd, Carbon::now()->toDateTime()]);
            $server->push($request->fd, (string) new HeartBeatMessage());
        });
    }
}