<?php

declare(strict_types=1);


use Hyperf\Tracer\Middleware\TraceMiddeware;

return [
    'http' => [
        \App\Middleware\Info::class,
        TraceMiddeware::class,
    ],
];
