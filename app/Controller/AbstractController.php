<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

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
    private $logger;

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
}
