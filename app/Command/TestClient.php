<?php

declare(strict_types=1);

namespace App\Command;

use App\IM\Packet\Impl\HeartBeatPacket;
use App\IM\Packet\Impl\MessageData;
use App\IM\Pack\PackIf;
use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpMessage\Uri\Uri;
use Hyperf\WebSocketClient\Client;
use Psr\Container\ContainerInterface;
use Swoole\Timer;

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
     * @var PackIf
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
        Timer::tick(3000, function ()  use ($ws) {
            $ws->push($this->packert->pack(new HeartBeatPacket()));
        });

        $msg = '你好';
        while (true) {
            echo "请输入内容:";
            $msg = fgets(STDIN);
            echo sprintf("输入的内容为: %s\n", $msg);

            $ws->push($this->packert->pack((new MessageData())->setData(['txt' => $msg])));

            $frame = $ws->recv();
            if ($frame === false) {
                usleep(300 * 000);
                $ws = new Client($uri);
            }

            $operate = $this->packert->unpack($frame->getData());
            $this->line($operate->__toString() . "\n");
        }
    }
}
