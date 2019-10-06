<?php


namespace App\IM\Command\Impl;


use App\IM\Command\Message;
use App\IM\Handler\CodeEnum;

class ServerError extends Message
{
    protected $op = CodeEnum::OP_SERVER_ERROR;
}