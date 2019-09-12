<?php

declare(strict_types=1);


namespace App\Controller;

use App\Utils\LogUtils;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Container\ContainerInterface;

abstract class AbstractController
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->request = $container->get(RequestInterface::class);
        $this->response = $container->get(ResponseInterface::class);

        $this->logger = LogUtils::get(static::class);
    }

    /**
     * @param RequestInterface $request
     * @return array
     */
    protected function validatePageLimit(RequestInterface $request): array
    {
        $page = (int) $request->query('page', 1);
        $limit = (int) $request->query('limit', 10);

        if ($page <= 0) {
            $this->logger->info("page {$page} ==> 1");
            $page = 1;
        }

        if ($limit < 5) {
            $this->logger->info("limit {$limit} ==> 5");
            $limit = 5;
        } elseif ($limit > 50) {
            $this->logger->info("limit {$limit} ==> 50");
            $limit = 50;
        }

        return [$page, $limit];
    }

    /**
     * @param ResponseInterface $response
     * @param array|object $data
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function success(ResponseInterface $response, $data = []): \Psr\Http\Message\ResponseInterface
    {
        $data = [
            'code' => 0,
            'message' => 'success',
            'data' => $data,
        ];

        return $response->json($data);
    }
}
