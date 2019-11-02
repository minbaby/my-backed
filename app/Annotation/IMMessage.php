<?php

namespace App\Annotation;

use App\IM\Command\Message;
use App\Utils\MessageUtils;
use Doctrine\Common\Annotations\Annotation\Target;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * @Annotation
 * @Target("CLASS")
 */
class IMMessage extends AbstractAnnotation
{
    /**
     * @param string $className
     */
    public function collectClass(string $className): void
    {
        parent::collectClass($className);

        /** @var Message $message */
        $message = make($className);
        MessageUtils::set($message->getOp(), $className);
    }
}