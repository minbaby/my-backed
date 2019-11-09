<?php

namespace App\Annotation;

use App\IM\Packet\Packet;
use App\Utils\PacketUtils;
use Doctrine\Common\Annotations\Annotation\Target;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * @Annotation
 * @Target("CLASS")
 */
class PacketAnnotation extends AbstractAnnotation
{
    /**
     * @param string $className
     */
    public function collectClass(string $className): void
    {
        parent::collectClass($className);

        /** @var Packet $packet */
        $packet = make($className);
        PacketUtils::set($packet->getOp(), $className);
    }
}