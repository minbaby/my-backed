<?php


namespace App\IM\Handler\Impl;


use App\Annotation\IMHandler;
use App\IM\Command\CommandEnum;
use App\IM\Command\Message;
use App\IM\Handler\AbstractHandler;
use App\Utils\SessionContext;
use Swoole\Server;
use Swoole\WebSocket\Frame;

/**
 * Class HeartbeatHandler
 * @package App\IM\Handler\Impl
 * @IMHandler()
 */
class HeartbeatHandler extends AbstractHandler
{
    const OP = CommandEnum::OP_HEARTBEAT;

    public function handler(Message $message, SessionContext $context): ?Message
    {
        $this->logger->debug(__METHOD__, ['fd' => $context->get('frame')->fd]);
        return null;
    }

}