<?php


namespace App\IM\Handler\Impl;


use App\Constants\StatusEnum;
use App\IM\Handler\AbstractHandler;
use App\IM\Packet\Message;
use App\IM\Packet\MessageData;
use App\IM\Packet\Packet;
use App\IM\Packet\ResponseBody;
use App\Utils\SessionContext;

class MessageHandler extends AbstractHandler
{

    /**
     * @param MessageData|Packet $packet
     * @param SessionContext $context
     * @return Packet|null
     */
    public function handler(Packet $packet, SessionContext $context): ?Packet
    {
        $message = make(Message::class);
        $responseBody = make(ResponseBody::class)
            ->setCode(StatusEnum::OK)
            ->setData($message);
        return make(MessageData::class)->setBody($responseBody);
    }
}