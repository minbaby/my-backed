<?php


namespace App\IM\Handler\Processor\Chat;


use App\Constants\ChatType;
use App\IM\Packet\ChatMessage;
use App\Utils\SessionContext;

class ChatMessageProcessor implements ChatMessageProcessorIf
{

    public function process(ChatMessage $chatMessage, SessionContext $context)
    {
        if ($chatMessage->getChatType() === ChatType::PUBLIC) {

        }
    }

    public function name()
    {
        return 'xxxx';
    }
}