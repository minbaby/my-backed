<?php

namespace App\IM\Handler\Impl;

use App\Annotation\IMHandler;
use App\IM\Command\CommandEnum;
use App\IM\Command\Impl\Message\MessageData;
use App\IM\Command\Impl\ResponseBody;
use App\IM\Command\Message;
use App\IM\Handler\AbstractHandler;
use App\IM\Service\UserService;
use App\Utils\SessionContext;
use Hyperf\Di\Annotation\Inject;

/**
 * Class MessageDataHandler
 * @package App\IM\Handler\Impl
 * @IMHandler()
 */
class MessageDataHandler extends AbstractHandler
{
    const OP = CommandEnum::OP_MESSAGE_DATA;

    /**
     * @var UserService
     * @Inject()
     */
    protected $userService;

    /**
     * @param Message|MessageData $message
     * @param SessionContext $context
     * @return Message|MessageData
     */
    public function handler(Message $message, SessionContext $context): ?Message
    {
        return (new MessageData())->setData(['txt' => $message->getData()['txt']]);
    }
}