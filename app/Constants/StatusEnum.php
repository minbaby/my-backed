<?php


namespace App\Constants;


use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;
use Hyperf\Constants\AnnotationReader;
use Hyperf\Constants\ConstantsCollector;

/**
 * @Constants()
 * @method static getMessage(int $code, $param = [])
 */
final class StatusEnum extends AbstractConstants
{
    /**
     * @Message("发送成功")
     */
    const OK = 10000;
}