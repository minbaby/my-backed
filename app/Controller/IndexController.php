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
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class IndexController
 * @package App\Controller
 * @Controller(prefix="/api/")
 */
class IndexController extends AbstractController
{
    /**
     * @return array
     * @GetMapping(path="/api/home/index")
     */
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        $ret = [];
        foreach(range(0, 100) as $i) {
            $ret[] = [
                "name" => "key=>{$i}",
                "age" => $i,
                "address" => "stress $i",
                "tags" => ["tag->{$i}"],
            ];
        }
        return $ret;
    }
}
