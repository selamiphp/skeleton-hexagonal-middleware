<?php
declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface;
use Selami\Router\Router;
use Selami\View\ViewInterface;

return [
    'app' => [
        'app_namespace' => 'MyApp',
        'environment' => getenv('SELAMI_ENVIRONMENT'),
        'cache_dir' => './cache',
        'config_cache_enabled' => getenv('SELAMI_ENVIRONMENT') === 'prod' ?? false, // enable on production
        'router_cache_enabled' => getenv('SELAMI_ENVIRONMENT') === 'prod' ?? false,
        'view_cache_enabled' => getenv('SELAMI_ENVIRONMENT') === 'prod' ?? false, // change to a valid file path to enable caching  on production
    ],
    'dependencies' => [
        'factories' => [
            ServerRequestInterface::class => Web\Factory\ServerRequestFactory::class,
            Router::class => Web\Factory\RouterFactory::class,
            Twig_Environment::class => Web\Factory\TwigFactory::class,
            ViewInterface::class => Web\Factory\SelamiViewTwigFactory::class,
        ]
    ],
];
