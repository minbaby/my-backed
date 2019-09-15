<?php

declare(strict_types=1);


use Hyperf\HttpServer\Router\Router;

//Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::addServer('ws', function () {
    Router::get('/ws', App\Controller\WebSocketController::class);
});