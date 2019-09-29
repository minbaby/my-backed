<?php


namespace App\IM\Handler\Impl;

use App\IM\Handler\AbstractHandler;
use App\IM\Handler\Operate;
use Psr\Container\ContainerInterface;
use Swoole\Server;
use Swoole\WebSocket\Frame;

class ServerErrorHandler extends AbstractHandler
{
    /**
     * @var ContainerInterface
     */
    private $container;

    private $error;

    public function __construct(ContainerInterface $container, $error)
    {
        parent::__construct($container);
        $this->container = $container;
        $this->error = $error;
    }

    public function handler(Server $server, Frame $frame, Operate $operate)
    {
    }
}