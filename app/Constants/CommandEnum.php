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
    /**
     * @Message("init")
     * @OpString("op.%s.UNKNOWN")
     */
    const OP_UNKNOWN = 0x0001;

    /**
     * @Message("server error")
     * @OpString("op.%s.server_error")
     */
    const OP_SERVER_ERROR = 0x0002;

    /**
     * @Message("no permisson")
     * @OpString("op.%s.no_permisson")
     */
    const OP_NO_PERMISSION = 0x0003;

    /**
     * @Message("handler not found")
     * @OpString("op.%s.not_found")
     */
    const OP_NOT_FOUND = 0x0005;

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