<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\TagService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
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
        return $this->success($response, $this->tagService->list($page, $limit))
            ->withAddedHeader('page', (string) $page)
            ->withAddedHeader('limit', (string) $limit);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return \Psr\Http\Message\ResponseInterface
     * @PostMapping(path="/api/tags")
     */
    public function create(RequestInterface $request, ResponseInterface $response)
    {
        $cnName = (string) $request->input('cn_name');
        $enName = (string) $request->input('en_name');

        $this->tagService->create($cnName, $enName);

        return $this->success($response);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param string $id
     * @return \Psr\Http\Message\ResponseInterface
     * @GetMapping(path="{id}")
     */
    public function getById(RequestInterface $request, ResponseInterface $response, string $id)
    {
        return $this->success($response, $this->tagService->getById((int) $id));
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param string $id
     * @return \Psr\Http\Message\ResponseInterface
     * @DeleteMapping(path="{id}")
     */
    public function remove(RequestInterface $request, ResponseInterface $response, $id)
    {
        $this->tagService->remove((int) $id);
        return $this->success($response, []);
    }

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param string $id
     * @PutMapping(path="{id}")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function save(RequestInterface $request, ResponseInterface $response, string $id)
    {
        $id = (int) $id;
        $cnName = (string) $request->input('cn_name');
        $enName = (string) $request->input('en_name');

        $this->tagService->save($id, $cnName, $enName);

        return $this->success($response);
    }
}
