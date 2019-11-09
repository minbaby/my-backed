<?php


namespace App\IM\Handler\Impl;


use App\Annotation\PacketHandlerAnnotation;
use App\Constants\CommandEnum;
use App\Constants\StatusEnum;
use App\IM\Packet\HeartBeatPacket;
use App\IM\Packet\Packet;
use App\IM\Handler\AbstractHandler;
use App\IM\Packet\ResponseBody;
use App\Utils\SessionContext;
use Swoole\Http\Response;

/**
 * @PacketHandlerAnnotation
 */
class HeartbeatHandler extends AbstractHandler
{
    const OP = CommandEnum::OP_HEARTBEAT;

    /**
     * @param Packet $message
     * @param SessionContext $context
     * @return Packet|null
     */
    public function handler(Packet $message, SessionContext $context): ?Packet
    {
        $this->logger->debug(__METHOD__, ['fd' => $context->get('frame')->fd]);
        return make(HeartBeatPacket::class)->setBody(new ResponseBody(StatusEnum::OK));
    }
}