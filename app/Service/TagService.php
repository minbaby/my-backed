<?php
declare(strict_types=1);

namespace App\Service;

use App\Repository\TagRepository;
use Hyperf\Di\Annotation\Inject;

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
        return $this->tagRepository->list($page, $limit)->toArray();
    }
}
