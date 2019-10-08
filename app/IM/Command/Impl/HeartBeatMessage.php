<?php

namespace App\IM\Command\Impl;

use App\Annotation\IMMessage;
use App\IM\Command\Message;
use App\IM\Command\CommandEnum;

/**
 * Class HeartBeatMessage
 * @package App\IM\Command\Impl
 * @IMMessage()
 */
class HeartBeatMessage extends Message
{
    protected $op = CommandEnum::OP_HEARTBEAT;
}