<?php
declare(strict_types=1);

namespace App\Controller;

use App\Utils\LogUtils;
use Hyperf\Contract\OnCloseInterface;
use Hyperf\Contract\OnMessageInterface;
use Hyperf\Contract\OnOpenInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\Utils\Arr;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Swoole\Http\Request;
use Swoole\Server;
use Swoole\Websocket\Frame;

/**
 * Class WebSocketController
 * @package App\Controller
 * @Controller()
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

    public function __construct()
    {
        $this->logger = LogUtils::get(__CLASS__);
    }


    public function onMessage(Server $server, Frame $frame): void
    {

        $this->logger->info(__METHOD__, [$frame->data, $frame->fd]);

        $opEvent = OpEventFactory::create($server, $frame);

        $this->logger->info(__METHOD__, ['op event created']);

        $this->eventDispatcher->dispatch($opEvent);
    }

    public function onClose(Server $server, int $fd, int $reactorId): void
    {
        $this->logger->info(__METHOD__, [$fd, $reactorId]);
    }

    public function onOpen(Server $server, Request $request): void
    {
        $this->logger->info(__METHOD__, [$request->fd]);
    }

    private function error()
    {
        return $this->s([
            'op' => 'error',
            'message' => 'unsupported op',
            'data' => [],
        ]);
    }

    private function s($data): string
    {
        $ret = [];
        if (Arr::accessible($data)) {
            $ret = $data;
        }

        return json_encode($ret);
    }
}

class OpEventFactory
{
    /**
     * @var ContainerInterface
     * @Inject()
     */
    protected static $container;

    private function __construct()
    {
    }

    public static function create(Server $server, Frame $frame): Event
    {
        LogUtils::get('ws:op')->info('request data', ['fid' => $frame->fd, 'data' => $frame->data, 'opcode' => $frame->opcode, 'finish'  => $frame->finish]);

        $ret = UnsupportedOpEvent::class;
        $json = @json_decode($frame->data, true);

        if ($json == null || !isset($json['op'])) {
            LogUtils::get('ws:op')->info('fire event error ' . $ret, []);
            return make($ret, [$server, $frame, []]);
        }

        switch ($json['op']) {
            default:
                $ret = UnsupportedOpEvent::class;
        }

        LogUtils::get('ws:op')->info('fire event ' . $ret, []);

        return make($ret, [$server, $frame, []]);
    }
}

class Event
{
    /**
     * @var array
     */
    protected $data;
    /**
     * @var Server
     */
    private $server;
    /**
     * @var Frame
     */
    private $frame;

    public function __construct(Server $server, Frame $frame, array $data)
    {
        $this->data = $data;
        $this->server = $server;
        $this->frame = $frame;
    }

    /**
     * @return Server
     */
    public function getServer(): Server
    {
        return $this->server;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return Frame
     */
    public function getFrame(): Frame
    {
        return $this->frame;
    }
}

class UnsupportedOpEvent extends Event
{
}

class LoginEvent extends Event
{

}