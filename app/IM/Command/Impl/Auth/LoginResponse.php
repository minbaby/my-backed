<?php


namespace App\IM\Command\Impl\Auth;


use App\IM\Command\Impl\ResponseBody;
use App\IM\Command\CommandEnum;

class LoginResponse extends ResponseBody
{
    protected $op = CommandEnum::OP_AUTH_LOGIN_REQ;

    public function reset()
    {
    }
}