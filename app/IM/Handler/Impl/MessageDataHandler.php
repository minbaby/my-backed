<?php

namespace App\IM\Handler\Impl;

use App\Annotation\Handler;
use App\IM\Command\CommandEnum;
use App\IM\Command\Impl\Message\MessageData;
use App\IM\Command\Message;
use App\IM\Handler\AbstractHandler;
use App\Utils\SessionContext;

/**
 * Class MessageDataHandler
 * @package App\IM\Handler\Impl
 * @Handler()
 */
class MessageDataHandler extends AbstractHandler
{
    const OP = CommandEnum::OP_MESSAGE_DATA;

    /**
     * @param Message|MessageData $message
     * @param SessionContext $context
     * @return Message
     */
    public function handler(Message $message, SessionContext $context): Message
    {
    }

    public function getOp(): int
    {
        return CommandEnum::OP_MESSAGE_DATA;
    }
}