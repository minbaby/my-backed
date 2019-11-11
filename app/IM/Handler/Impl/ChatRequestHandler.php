<?php


namespace App\IM\Handler\Impl;


use App\Annotation\PacketHandlerAnnotation;
use App\Constants\ChatType;
use App\Constants\CommandEnum;
use App\Constants\StatusEnum;
use App\IM\Handler\AbstractHandler;
use App\IM\Handler\Processor\Chat\ChatMessageProcessor;
use App\IM\Packet\ChatMessagePacket;
use App\IM\Packet\Packet;
use App\IM\Packet\ResponseBody;
use App\Utils\SessionContext;
use Hyperf\Di\Annotation\Inject;
use PHPMD\TextUI\Command;

/**
 * Class ChatHandler
 * @package App\IM\Handler\Impl
 * @PacketHandlerAnnotation()
 */
class ChatRequestHandler extends AbstractHandler
{
    /**
     * @Inject()
     * @var ChatMessageProcessor
     */
    protected $process;

    /**
     * @param Packet|ChatMessagePacket $packet
     * @param SessionContext $context
     * @return Packet|null
     */
    public function handler(Packet $packet, SessionContext $context): ?Packet
    {
        $response = make(ResponseBody::class)->setCode(StatusEnum::SEND_FAILED);
        $retPacket = make(ChatMessagePacket::class)->setOp(CommandEnum::OP_CHAT_RESPONSE);

        if ($packet->getChatType() == null || $packet->getTo() == null) {
            return $retPacket->setBody($response);
        }

        $this->process->process($packet, $context);

        // TODO, save message

        $responsePacket = clone $packet;

        if ($responsePacket->getChatType() == ChatType::PRIVATE) {
            // send to user
        } elseif ($responsePacket->getTo() == ChatType::PUBLIC) {
            //TODO send to group
        }

        return $retPacket->setBody($response);
    }
}