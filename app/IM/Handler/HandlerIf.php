<?php


namespace App\IM\Handler;


use App\Constants\CommandEnum;
use App\IM\Packet\Message;
use App\IM\Packet\Packet;
use App\Utils\SessionContext;

interface HandlerIf
{
    const OP = CommandEnum::OP_UNKNOWN;

    public function getOp(): int;

    /**
     * @param Packet $message
     * @param SessionContext $context
     * @return Packet|null
     */
    public function handler(Packet $message, SessionContext $context): ?Packet;
}