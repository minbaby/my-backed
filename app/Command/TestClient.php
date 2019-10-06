<?php

declare(strict_types=1);

namespace App\Command;

use App\IM\Command\Impl\HeartBeatMessage;
use App\IM\Handler\CodeEnum;
use App\IM\Packet\PacketIf;
use Hyperf\Command\Annotation\Command;
use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Di\Annotation\Inject;
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
        /** @var PacketIf $packer */
        $packer = $this->container->get(PacketIf::class);
        $hb = $packer->unpack((string) new HeartBeatMessage());
        var_dump($hb->toArray());
//        $uri = new Uri('ws://127.0.0.1:9502/ws');
//        $ws = new Client($uri);
//        $ws->push((string) new HeartBeatMessage());
//        while (true) {
//            $frame = $ws->recv(5);
//            if (empty($frame)) {
//                $this->line("empty" . (string) $frame);
//                continue;
//            }
//
//            $operate = $this->packert->unpack($frame->getData());
//            $this->line($operate->__toString() . "\n");
//
//        }
    }
}
