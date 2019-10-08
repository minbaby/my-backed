<?php


namespace App\IM\Service;


use Hyperf\Di\Annotation\Inject;
use \Redis;

class MessageService
{
    /**
     * @var Redis
     * @Inject()
     */
    protected $redis;
    /**
     * @param string $from
     * @param string $to
     * @param string $msg
     */
    public function sendTo(string $from, string $to, string $msg)
    {
        $this->redis->set("$from->$to", $msg);
    }
}