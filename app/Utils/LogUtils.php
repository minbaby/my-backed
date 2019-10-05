<?php

declare(strict_types=1);

namespace App\Utils;

use Hyperf\Logger\LoggerFactory;
use Hyperf\Utils\ApplicationContext;

class LogUtils
{
    /**
     * @param string $name
     * @return \Psr\Log\LoggerInterface
     */
    public static function get(string $name = 'app')
    {
        return ApplicationContext::getContainer()->get(LoggerFactory::class)->get($name);
    }
}
