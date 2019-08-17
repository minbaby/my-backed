<?php
declare(strict_types=1);

namespace App\Service;

use App\Constants\ErrorCode;
use App\Exception\BusinessException;
use App\Repository\TagRepository;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Paginator\LengthAwarePaginator;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;

class TagService
{
    /**
     * @Inject()
     * @var TagRepository
     */

    protected $tagRepository;
    /**
     * @param int $page
     * @param int $limit
     * @return array
     */
    public function list(int $page, int $limit): array
    {
        $pagination = $this->tagRepository->list($page, $limit);
        $data = $pagination->getCollection()->map(function ($value) {
            return $value;
        });

        return $pagination->setCollection($data)->toArray();
    }

    public function remove(int $id)
    {
        return $this->tagRepository->remove($id);
    }

    public function getById(int $id)
    {
        return $this->tagRepository->get($id);
    }

    /**
     * @param int $id
     * @param string $cnName
     * @param string $enName
     * @return int
     */
    public function save(int $id, string $cnName, string $enName):int
    {
        $data = $this->getById($id);
        if (empty($data)) {
            BusinessException::throw(ErrorCode::NOT_FOUND, null, ['tags']);
        }

        return $this->tagRepository->save($id, $cnName, $enName);
    }
}
