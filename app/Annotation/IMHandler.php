<?php


namespace App\Annotation;


use App\IM\Handler\HandlerIf;
use App\Utils\HandlerUtils;
use Doctrine\Common\Annotations\Annotation\Target;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * @Annotation
 * @Target("CLASS")
 */
class IMHandler extends AbstractAnnotation
{
    /**
     * @param string $className
     */
    public function collectClass(string $className): void
    {
        parent::collectClass($className);

        /**@var HandlerIf $className */
        HandlerUtils::set($className::OP, $className);
    }
}