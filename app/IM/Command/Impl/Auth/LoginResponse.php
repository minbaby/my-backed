<?php


namespace App\IM\Command\Impl\Auth;


use App\IM\Command\Impl\ResponseBody;
use App\IM\Handler\CodeEnum;

class LoginResponse extends ResponseBody
{
    protected $op = CodeEnum::OP_AUTH_LOGIN_REQ;
}