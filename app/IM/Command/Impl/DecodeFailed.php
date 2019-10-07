<?php


namespace App\IM\Command\Impl;


use App\IM\Command\Message;
use App\IM\Command\CommandEnum;

class DecodeFailed extends Message
{
    protected $op = CommandEnum::OP_DECODE_FAILED;
}