<?php


namespace App\IM\Handler;


use App\IM\Command\CommandEnum;
use App\IM\Command\Message;
use App\Utils\SessionContext;

interface HandlerIf
{
    const OP = CommandEnum::OP_UNKNOW;

    public function getOp(): int;

    /**
     * @param Message $message
     * @param SessionContext $context
     * @return Message|null
     */
    public function handler(Message $message, SessionContext $context): ?Message;
}