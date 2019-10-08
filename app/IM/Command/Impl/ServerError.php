<?php


namespace App\IM\Command\Impl;


use App\IM\Command\Message;
use App\IM\Command\CommandEnum;

class ServerError extends Message
{
    protected $op = CommandEnum::OP_SERVER_ERROR;
}