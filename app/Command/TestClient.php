<?php

declare(strict_types=1);

namespace App\Command;

use App\IM\Handler\CodeEnum;
use App\IM\Handler\Operate;
use App\IM\Packet\PacketIf;
use Carbon\Carbon;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Command\Annotation\Command;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpMessage\Uri\Uri;
use Hyperf\WebSocketClient\Client;
use Psr\Container\ContainerInterface;

/**
 * @Command
 */
class TestClient extends HyperfCommand
{
    protected $coroutine = true;
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var PacketIf
     * @Inject()
     */
    protected $packert;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        parent::__construct('test');
    }

    public function configure()
    {
        $this->setDescription('Hyperf Demo Command');
    }

    public function handle()
    {
        $uri = new Uri('ws://127.0.0.1:9502/ws');
        $ws = new Client($uri);
        $ws->push((string) new Operate(CodeEnum::OP_SUCCESS));
        while (true) {
            $frame = $ws->recv(5);
            if (empty($frame)) {
                $this->line("empty" . (string) $frame);
                continue;
            }

            $operate = $this->packert->unpack($frame->getData());
            $this->line($operate->__toString() . "\n");

        }
    }
}
