<?php


namespace App\IM\Handler\Impl;


use App\Annotation\PacketHandlerAnnotation;
use App\Constants\CommandEnum;
use App\Constants\StatusEnum;
use App\IM\Packet\DecodeFailedPacket;
use App\IM\Packet\HeartBeatPacket;
use App\IM\Packet\Packet;
use App\IM\Handler\AbstractHandler;
use App\IM\Packet\ResponseBody;
use App\Utils\SessionContext;
use Hyperf\Utils\Str;
use Swoole\Http\Response;

/**
 * @PacketHandlerAnnotation
 */
class DecodeFailedHandler extends AbstractHandler
{
    const OP = CommandEnum::OP_DECODE_FAILED;

    /**
     * @param Packet $packet
     * @param SessionContext $context
     * @return Packet|null
     */
    public function handler(Packet $packet, SessionContext $context): ?Packet
    {
        $this->logger->debug(__METHOD__, ['fd' => $context->get('frame')->fd]);
        return make(DecodeFailedPacket::class)->setId(Str::random());
    }
}