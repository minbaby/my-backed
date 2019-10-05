<?php

namespace App\IM\Handler;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;

/**
 * @Constants
 * @method static getMessage(int $code, $param = [])
 * @method static getOpString(int $code, $param = []);
 */
final class CodeEnum extends AbstractConstants
{
    /**
     * @Message("success")
     * @OpString("op.handler.success")
     */
    const OP_SUCCESS = 0;

    /**
     * @Message("server error")
     * @OpString("op.handler.server_error")
     */
    const OP_SERVER_ERROR = 1;

    /**
     * @Message("no permisson")
     * @OpString("op.handler.no_permisson")
     */
    const OP_NO_PERMISSION = 2;

    /**
     * @Message("handler not found")
     * @OpString("op.handler.not_found")
     */
    const OP_NOT_FOUND = 20;

    /**
     * @Message("decode failed")
     * @OpString("op.handler.decode_failed")
     */
    const OP_DECODE_FAILED = 10;

    /**
     * @Message("heartbeat")
     * @OpString("op.handler.heartbeat")
     */
    const OP_HEARTBEAT = 11;
}