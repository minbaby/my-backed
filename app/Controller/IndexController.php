<?php

declare(strict_types=1);


namespace App\Controller;

use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;

/**
 * Class IndexController.
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
        foreach (range(0, 100) as $i) {
            $ret[] = [
                'name' => "key=>{$i}",
                'age' => $i,
                'address' => "stress {$i}",
                'tags' => ["tag->{$i}"],
            ];
        }
        return $ret;
    }
}
