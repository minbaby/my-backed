<?php

namespace App\IM\Packet;

use App\Constants\CommandEnum;

class ServerError extends Packet
{
    protected $op = CommandEnum::OP_SERVER_ERROR;
}