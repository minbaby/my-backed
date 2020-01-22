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
    const OP_UNKNOWN = 0;

    /**
     * @Message("heartbeat")
     * @OpString("op.%s.heartbeat")
     */
    const OP_HEARTBEAT = 1;

    const OP_DECODE_FAILED = 2;

    const OP_SINGLE_MESSAGE = 100;

    const OP_GROUP_MESSAGE = 200;
}