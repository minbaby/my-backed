<?php
declare(strict_types=1);

namespace App\Repository;

use App\Model\Tags;
use Hyperf\Contract\LengthAwarePaginatorInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\Paginator\LengthAwarePaginator;

class TagRepository
{
    /**
     * @Inject()
     * @var Tags
     */
    protected $tags;

    /**
     * @param int $page
     * @param int $limit
     * @return LengthAwarePaginatorInterface|LengthAwarePaginator
     */
    public function list(int $page, int $limit): LengthAwarePaginatorInterface
    {
        return $this->tags->newQuery()->paginate($limit, ['*'], 'page', $page);
    }

    public function remove(int $id)
    {
        $this->tags->newQuery()->where('id', $id)->delete();
    }

    public function get(int $id)
    {
        return $this->tags->newQuery()->where('id', $id)->first();
    }
}
