<?php

namespace App\IM\Command\Impl;

use App\IM\Command\Message;
use App\IM\Command\CommandEnum;

class HeartBeatMessage extends Message
{
    protected $op = CommandEnum::OP_HEARTBEAT;
}