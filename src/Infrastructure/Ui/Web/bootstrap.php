<?php
declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface;
use Zend\HttpHandlerRunner\Emitter\EmitterStack;
use Zend\HttpHandlerRunner\Emitter\SapiEmitter;
use Zend\HttpHandlerRunner\RequestHandlerRunner;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;
use Zend\Stratigility\Middleware\ErrorResponseGenerator;

require 'vendor/autoload.php';

$container = include __DIR__ . '/container.php';
$application = require __DIR__ . '/pipeline.php';

$stack = new EmitterStack();
$stack->push(new SapiEmitter());
$serverRequestFactory = function() use ($container) {
    return $container->get(ServerRequestInterface::class);
};
$errorResponseGenerator = function (Throwable $e) {
    $generator = new ErrorResponseGenerator();
    return $generator($e, new ServerRequest(), new Response());
};
$runner = new RequestHandlerRunner(
    $application,
    $stack,
    $serverRequestFactory,
    $errorResponseGenerator
);

$runner->run();
