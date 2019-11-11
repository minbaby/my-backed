<?php

namespace App\IM\Handler\Processor\Chat;

use App\IM\Handler\Processor\ProcessIf;
use App\IM\Packet\ChatMessagePacket;
use App\Utils\SessionContext;

interface ChatMessageProcessorIf extends ProcessIf
{
    public function process(ChatMessagePacket $chatMessage, SessionContext $context);
}