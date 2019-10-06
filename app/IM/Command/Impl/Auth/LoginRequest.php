<?php


namespace App\IM\Command\Impl\Auth;


use App\IM\Command\Message;
use App\IM\Handler\CodeEnum;

class LoginRequest extends Message
{
    protected $op = CodeEnum::OP_AUTH_LOGIN_REQ;

    protected $userName;

    protected $password;

    /**
     * @param mixed $password
     * @return LoginRequest
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $userName
     * @return LoginRequest
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }
}