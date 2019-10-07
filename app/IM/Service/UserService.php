<?php


namespace App\IM\Service;


class UserService
{
    protected $uid2fd = [];

    protected $fd2uid = [];

    /**
     * @param string $uid
     * @param int $fd
     */
    public function online(string $uid, int $fd)
    {
        $this->uid2fd[$uid] = $fd;
        $this->fd2uid[$fd] = $uid;
    }

    /**
     * @param string $uid
     */
    public function offline(string $uid)
    {
        $fd = $this->uid2fd[$uid];
        unset($this->fd2uid[$fd], $this->uid2fd[$uid]);
    }

    public function getFd(string $uid)
    {
        return $this->uid2fd[$uid] ?? 0;
    }

    public function isOnline(string $uid): bool
    {
        return isset($this->uid2fd[$uid]) ? true : false;
    }
}