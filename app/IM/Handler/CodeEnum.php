<?php

namespace App\IM\Handler;

use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;
use Hyperf\Constants\AnnotationReader;
use Hyperf\Constants\ConstantsCollector;

/**
 * @Constants
 * @method static getMessage(int $code, $param = [])
 */
final class CodeEnum extends AbstractConstants
{
    const TYPE_HANDLER = 'handler';

    const TYPE_MESSAGE = 'message';

    /**
     * @Message("success")
     * @OpString("op.%s.success")
     */
    const OP_SUCCESS = 0;

    /**
     * @Message("server error")
     * @OpString("op.%s.server_error")
     */
    const OP_SERVER_ERROR = 1;

    /**
     * @Message("no permisson")
     * @OpString("op.%s.no_permisson")
     */
    const OP_NO_PERMISSION = 2;

    /**
     * @Message("handler not found")
     * @OpString("op.%s.not_found")
     */
    const OP_NOT_FOUND = 3;

    /**
     * @Message("decode failed")
     * @OpString("op.%s.decode_failed")
     */
    const OP_DECODE_FAILED = 4;

    /**
     * @Message("heartbeat")
     * @OpString("op.%s.heartbeat")
     */
    const OP_HEARTBEAT = 5;

    public static function getOpString(int $code, $arguments = []): string
    {
        $data = ConstantsCollector::has(static::class);
        if (empty($data)) {
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