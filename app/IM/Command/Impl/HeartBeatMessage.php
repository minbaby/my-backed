<?php

namespace App\IM\Command\Impl;

use App\IM\Command\Message;
use App\IM\Handler\CodeEnum;

class HeartBeatMessage extends Message
{
    protected $op = CodeEnum::OP_HEARTBEAT;
}