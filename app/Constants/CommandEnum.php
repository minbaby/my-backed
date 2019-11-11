<?php

namespace App\Constants;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;
use Hyperf\Constants\AnnotationReader;
use Hyperf\Constants\ConstantsCollector;

/**
 * @Constants
 * @method static getMessage(int $code, $param = [])
 */
final class CommandEnum extends AbstractConstants
{
    const OP_UNKNOWN = 0x0001;

    const OP_SERVER_ERROR = 0x0002;

    const OP_CHAT_REQUEST = 0x0003;

    const OP_CHAT_RESPONSE = 0x0004;

    const OP_CHAT_RESPONSE2 = 0x0004;

    /**
     * @Message("decode failed")
     * @OpString("op.%s.decode_failed")
     */
    const OP_DECODE_FAILED = 0x0006;

    /**
     * @Message("heartbeat")
     * @OpString("op.%s.heartbeat")
     */
    const OP_HEARTBEAT = 0x0007;

    /**
     * @Message("??")
     * @OpString("op.%s.login_request")
     */
    const OP_AUTH_LOGIN_REQ = 0x0100;

    /**
     * @Message("?")
     * @OpString("op.%s.login_response")
     */
    const OP_AUTH_LOGIN_RESP = 0x0101;

    /**
     * @Message("??")
     * @OpString("op.%s.logout_request")
     */
    const OP_AUTH_LOGOUT_REQ = 0x0102;

    /**
     * @Message("?")
     * @OpString("op.%s.logout_response")
     */
    const OP_AUTH_LOGOUT_RESP = 0x0103;

    /**
     * @OpString("op.%s.message_data")
     */
    const OP_GET_MESSAGE_REQ = 0x0200;

    const OP_GET_MESSAGE_RESPONSE = 0x0201;
}