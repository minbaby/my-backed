<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\TagService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

/**
 * Class TagsController
 * @package App\Controller
 * @Controller(prefix="/api/tags")
 */
class TagsController extends AbstractController
{
    /**
     * @Inject()
     * @var TagService
     */
    protected $tagService;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return \Psr\Http\Message\ResponseInterface
     * @GetMapping(path="list")
     */
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        [$page, $limit] = $this->validatePageLimit($request);
        return $response
            ->json($this->tagService->list($page, $limit))
            ->withAddedHeader('page', (string) $page)
            ->withAddedHeader('limit', (string) $limit);
    }

    public function create(RequestInterface $request, ResponseInterface $response)
    {

    }

    public function remove(RequestInterface $request, ResponseInterface $response)
    {

    }

    public function save(RequestInterface $request, ResponseInterface $response)
    {

    }
}
