<?php


namespace App\IM\Handler\Processor\Chat;


use App\Constants\ChatType;
use App\IM\Packet\ChatMessage;
use App\Utils\ChatUtils;
use App\Utils\LogUtils;
use App\Utils\SessionContext;
use Hyperf\Logger\Logger;

class ChatMessageProcessor implements ChatMessageProcessorIf
{
    /**
     * @var Logger
     */
    protected $logger;

    public function __construct()
    {
        $this->logger = LogUtils::get(__CLASS__);
    }

    public function name()
    {
        return 'chat-message-processor';
    }

    public function process(ChatMessage $chatMessage, SessionContext $context)
    {
        if ($chatMessage->getChatType() === ChatType::UNKNOWN) {
            $this->logger->debug("chatType: unknown");
            return;
        }

        if ($chatMessage->getChatType() === ChatType::PUBLIC) {
            $this->pushGroupMessage();
        } else {
            $sessionId = ChatUtils::sessionId($chatMessage->getFrom(), $chatMessage->getTo());
            $this->writeMessage(ChatUtils::MESSAGE_STORE, "user:" . $sessionId, $chatMessage);
            if (ChatUtils::isOnline($chatMessage->getFrom())) {
                $this->writeMessage(ChatUtils::MESSAGE_PUSH, "user:" . $sessionId, $chatMessage);
            }
        }

        $this->doHandler($chatMessage, $context);
    }

    protected function pushGroupMessage()
    {

    }

    protected function writeMessage(string $string, string $param, ChatMessage $chatMessage)
    {

    }

    /**
     * @param ChatMessage $chatBody
     * @param SessionContext $channelContext
     */
    protected abstract function doHandler(ChatMessage $chatBody, SessionContext $channelContext);

}