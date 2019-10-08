<?php


namespace App\IM\Command\Impl;


use App\Annotation\IMMessage;
use App\IM\Command\Message;
use App\IM\Command\CommandEnum;

/**
 * Class DecodeFailed
 * @package App\IM\Command\Impl
 * @IMMessage()
 */
class DecodeFailed extends Message
{
    protected $op = CommandEnum::OP_DECODE_FAILED;
}