<?php


namespace App\IM\Command;


use Hyperf\Constants\AbstractConstants;
use Hyperf\Constants\Annotation\Constants;
use Hyperf\Constants\AnnotationReader;
use Hyperf\Constants\ConstantsCollector;

/**
 * Class StatusEnum
 * @package App\IM\Command
 * @Constants()
 */
class StatusEnum extends AbstractConstants
{
    const TYPE_DESC = 'Desc';
    const TYPE_TEXT = 'Text';

    /**
     * @Desc("ok")
     * @Text("发送成功")
     */
    const C10000 = 10000;

    /**
     * @Desc("get user message failed!")
     * @Text("获取用户消息失败!")
     */
    const C10015 = 10015;

    public static function getString(int $code, $arguments): string
    {
        if (!ConstantsCollector::has(static::class)) {
            $reader = new AnnotationReader();

            $ref = new \ReflectionClass(static::class);
            $classConstants = $ref->getReflectionConstants();
            $data = $reader->getAnnotations($classConstants);

            ConstantsCollector::set(static::class, $data);
        }

        $key =  array_shift($arguments);
        $message = ConstantsCollector::getValue(static::class, $code, $key);

        if (count($arguments) > 0) {
            return sprintf($message, ...$arguments);
        }

        return $message;
    }

    public static function getDesc($code)
    {
        return static::getString($code, [static::TYPE_DESC]);
    }

    public static function getText($code)
    {
        return static::getString($code, [static::TYPE_TEXT]);
    }
}