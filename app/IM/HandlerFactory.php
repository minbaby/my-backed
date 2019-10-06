<?php


namespace App\IM;

use App\IM\Handler\CodeEnum;
use App\IM\Handler\HandlerIf;
use App\IM\Handler\Impl\NoPermissionHandler;
use App\IM\Handler\Impl\ServerErrorHandler;
use App\IM\Handler\Command\Message;
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

    public function create(Message $operate): HandlerIf
    {
        try {
            LogUtils::get(__CLASS__)->info('create', $operate->toArray());

            $name = CodeEnum::getOpString($operate->getOp());
            if (!$this->container->has($name)) {
                $name = CodeEnum::getOpString(CodeEnum::OP_NOT_FOUND);
            }

            LogUtils::get(__CLASS__)->info('op got ' . $name);

            return $this->container->get($name);
        } catch (\Exception $exception) {
            LogUtils::get(__CLASS__)->info('get exception', [$exception->getCode(), $exception->getMessage()]);
            return new ServerErrorHandler($this->container, $exception);
        }
    }


    protected function checkPreHandler()
    {
        return $this->container->get(NoPermissionHandler::class);
    }
}