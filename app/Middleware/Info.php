<?php

namespace App\Middleware;

use App\Utils\LogUtils;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\Logger\Logger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class Info
 * @package App\Middleware
 * @Middleware()
 */
class Info implements MiddlewareInterface
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    public function __construct()
    {
        $this->logger = LogUtils::get('default');
    }

    /**
     * Process an incoming server request.
     *
     * Processes an incoming server request in order to produce a response.
     * If unable to produce the response itself, it may delegate to the provided
     * request handler to do so.
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->logger->error("YES");
        $this->logger->error($request->getUri());
        return $handler->handle($request);
    }
}