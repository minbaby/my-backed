<?php

declare(strict_types=1);


namespace App\Exception\Handler;

use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class AppExceptionHandler extends ExceptionHandler
{
    /**
     * @var StdoutLoggerInterface
     */
    protected $logger;

    public function __construct(StdoutLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $code = $throwable->getCode();
        if ($code >= 500) {
            $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
            $this->logger->error($throwable->getTraceAsString());
        }
        if ($code < 100 && $code >= 600) {
            $code = 500;
        }

        return $response->withStatus($code)
            ->withAddedHeader('content-type', 'application/json')
            ->withBody(new SwooleStream(json_encode([
                'code' => $code,
                'msg' => $throwable->getMessage(),
                'data' => [],
            ])));
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
