<?php

declare(strict_types=1);


error_reporting(E_ALL);

! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));

\Swoole\Runtime::enableCoroutine(true);

require BASE_PATH . '/vendor/autoload.php';

require BASE_PATH . '/config/container.php';
