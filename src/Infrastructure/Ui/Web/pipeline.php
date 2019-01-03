<?php
declare(strict_types=1);

use Zend\Stratigility\MiddlewarePipe;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Stratigility\Middleware\CallableMiddlewareDecorator;
use function Zend\Stratigility\path;
use function Zend\Stratigility\middleware;

$app = new MiddlewarePipe();

if (getenv('SELAMI_ENVIRONMENT') !== 'prod') {
    $app->pipe(new Middlewares\Whoops());
}

$app->pipe(new CallableMiddlewareDecorator(function (ServerRequestInterface $request, RequestHandlerInterface $handler) {
    $request = $request->withAttribute('session', ['data' => ['key' => 'value']]);
    return $handler->handle($request)->withHeader('X-Session', 'x-value');
}));

$app->pipe(new CallableMiddlewareDecorator(function (ServerRequestInterface $request, RequestHandlerInterface $handler) {
    $request = $request->withAttribute('cookie', ['data' => ['key' => 'value']]);
    return $handler->handle($request)->withHeader('Y-Session', 'y-value');;
}));

$app->pipe(new CallableMiddlewareDecorator(function (ServerRequestInterface $request, RequestHandlerInterface $handler) {
    $request = $request->withAttribute('authorization', 'passed');
    return $handler->handle($request);
}));

$app->pipe(path('/auth', new Web\Middleware\Authentication\Middleware($container)));

$app->pipe(new Web\Middleware\Application\Middleware($container));


return $app;