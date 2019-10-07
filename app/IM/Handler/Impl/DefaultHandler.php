<?php

namespace App\IM\Handler\Impl;

use App\IM\Command\CommandEnum;
use App\IM\Command\Impl\ResponseBody;
use App\IM\Command\Message;
use App\IM\Handler\AbstractHandler;
use App\Annotation\Handler;
use App\IM\Service\UserService;
use App\Utils\SessionContext;
use Hyperf\Di\Annotation\Inject;
use Swoole\WebSocket\Frame;

/**
 * @Handler()
 */
class DefaultHandler extends AbstractHandler
{
    /**
     * @var UserService
     * @Inject()
     */
    protected $userService;

    const OP = CommandEnum::OP_UNKNOW;

    /**
     * @param Message $message
     * @param SessionContext $context
     * @return Message
     */
    public function handler(Message $message, SessionContext $context): Message
    {
        /** @var Frame $frame */
        $frame = $context->get('frame');
        $this->userService->online('1', $frame->fd);
        return (new ResponseBody())->setOp(CommandEnum::OP_UNKNOW);
    }
}