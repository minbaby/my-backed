<?php


namespace App\IM;

use App\IM\Handler\Impl\NoPermissionHandler;
use App\IM\Handler\Impl\ServerErrorHandler;
use App\Utils\LogUtils;
use Hyperf\Di\Container;
use Hyperf\Utils\Str;
use Psr\Container\ContainerInterface;

class HandlerFactory
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * HandlerFactory constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function create(array $json)
    {
        try {
            LogUtils::get(__CLASS__)->info('x', $json);
            $name = $this->getDiName('not_supported');
            if ($json == null || !isset($json['op'])) {
                return $this->container->get($name);
            }

            $opName = $this->getDiName($json['op']);

            if ($this->container->has($opName)) {
                $name = $opName;
            }

            LogUtils::get(__CLASS__)->info('op exec ' . $name);

            return $this->container->get($name);
        } catch (\Exception $exception) {
            LogUtils::get(__CLASS__)->info('get exception', [$exception->getCode(), $exception->getMessage()]);
            return new ServerErrorHandler($this->container, $exception);
        }
    }

    /**
     * @param string $op
     * @return string
     */
    protected function getDiName(string $op): string
    {
        LogUtils::get(__CLASS__)->info('op ' . $op);
        return sprintf("\\App\\IM\\Handler\\Impl\\%sHandler", Str::studly($op));
    }

    protected function checkPreHandler()
    {
        return $this->container->get(NoPermissionHandler::class);
    }
}