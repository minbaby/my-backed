<?php

namespace App\IM\Handler;

use App\Utils\LogUtils;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Logger\LoggerFactory;
use Psr\Container\ContainerInterface;

abstract class AbstractHandler implements HandlerIf
{
    /**
     * @var LoggerFactory
     */
    protected $logger;

    /**
     * @var ContainerInterface
     * @Inject()
     */
    private $container;

    /**
     * AbstractHandler constructor.
     */
    public function __construct()
    {
        $this->logger = LogUtils::get(static::class);
    }

    public function getOp(): int
    {
        return static::OP;
    }
}