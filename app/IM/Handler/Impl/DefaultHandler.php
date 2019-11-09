<?php

namespace App\IM\Handler\Impl;

use App\Constants\CommandEnum;
use App\IM\Packet\Impl\ResponseBody;
use App\IM\Packet\Message;
use App\IM\Packet\Packet;
use App\IM\Handler\AbstractHandler;
use App\Annotation\PacketHandlerAnnotation;
use App\IM\Service\UserService;
use App\Utils\SessionContext;
use Hyperf\Di\Annotation\Inject;
use Swoole\WebSocket\Frame;

/**
 * @PacketHandlerAnnotation()
 */
class DefaultHandler extends AbstractHandler
{
    /**
     * @var UserService
     * @Inject()
     */
    protected $userService;

    const OP = CommandEnum::OP_UNKNOWN;

    /**
     * @param Packet $message
     * @param SessionContext $context
     * @return Packet|null
     */
    public function handler(Packet $message, SessionContext $context): ?Packet
    {
        return make(Packet::class)
            ->setOp(CommandEnum::OP_UNKNOWN)
            ->setBody([]);
    }
}