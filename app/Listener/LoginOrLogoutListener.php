<?php


namespace App\Listener;

use App\Controller\Event;
use App\Controller\LoginEvent;
use App\Utils\LogUtils;
use Hyperf\Event\Annotation\Listener;
use Hyperf\Event\Contract\ListenerInterface;
use Psr\Log\LoggerInterface;

/**
 * @Listener()
 */
class LoginOrLogoutListener implements ListenerInterface
{
    /**
     * @var LoggerInterface
     */
    protected $log;

    public function __construct()
    {
        $this->log = LogUtils::get(__METHOD__);
    }

    /**
     * @return string[] returns the events that you want to listen
     */
    public function listen(): array
    {
        return [
            LoginEvent::class
        ];
    }

    /**
     * Handle the Event when the event is triggered, all listeners will
     * complete before the event is returned to the EventDispatcher.
     * @var Event $event
     */
    public function process(object $event)
    {
        $this->log->info(__METHOD__ . ': start');
        LogUtils::get(__CLASS__)->info(__METHOD__);
        $event->getServer()->push($event->getFrame()->fd, json_encode($event->getData()));
        $this->log->info(__METHOD__ . ': end');
    }
}