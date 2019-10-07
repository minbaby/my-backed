<?php

namespace App\IM\Command;

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
    const TYPE_HANDLER = 'handler';

    const TYPE_MESSAGE = 'message';

    const STATUS_SUCCESS = 1;

    const STATUS_ERROR = 0;

    /**
     * @Message("init")
     * @OpString("op.%s.unknow")
     */
    const OP_UNKNOW = 0x0001;

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
    const OP_MESSAGE_DATA = 0x0200;

    public static function getOpString(int $code, $arguments): string
    {
        if (!ConstantsCollector::has(static::class)) {
            $reader = new AnnotationReader();

            $ref = new \ReflectionClass(static::class);
            $classConstants = $ref->getReflectionConstants();
            $data = $reader->getAnnotations($classConstants);

            ConstantsCollector::set(static::class, $data);
        }

        $message = ConstantsCollector::getValue(static::class, $code, 'opstring');

        if (count($arguments) > 0) {
            return sprintf($message, ...$arguments);
        }

        return $message;
    }

    public static function getHandlerString($code)
    {
        return static::getOpString($code, [static::TYPE_HANDLER]);
    }

    public static function getMessageString($code)
    {
        return static::getOpString($code, [static::TYPE_MESSAGE]);
    }
}