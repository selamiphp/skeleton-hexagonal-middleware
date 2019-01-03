<?php
declare(strict_types=1);

use Selami\Router\Router;

$twigConfig = [
    'debug' => true, // disable on production
    'strict_variables' => true, // disable on production
    'autoescape' => 'html',
    'auto_reload' => true, // disable on production
    'optimizations' => -1 // change to -1 on production
];

if(getenv('SELAMI_ENVIRONMENT') === 'prod') {
    $twigConfig = [
        'debug' => false, // disable on production
        'strict_variables' => false, // disable on production
        'autoescape' => 'html',
        'auto_reload' => false, // disable on production
        'optimizations' => -1 // change to -1 on production
    ];
}


return [
    'app' => [
        'http-error-handler' => Web\Middleware\ErrorHandler::class,
    ],
    'routes' => [
        'middleware-main-application' =>[
            [Router::GET, '/', Web\Application\Controller\Contents\Main::class, Router::HTML, 'home'],
            [Router::GET, '/category/{category}', Web\Application\Controller\Contents\Category::class, Router::HTML, 'category'],
            [Router::GET, '/{year}/{month}/{slug}', Web\Application\Controller\Contents\Post::class, Router::JSON, 'post'],
            [Router::GET, '/download', Web\Application\Controller\Contents\Download::class, Router::DOWNLOAD],
            [Router::GET, '/text', Web\Application\Controller\Contents\Text::class, Router::TEXT],
            [Router::GET, '/custom', Web\Application\Controller\Contents\Custom::class, Router::CUSTOM],
            [Router::GET, '/redirect', Web\Application\Controller\Contents\Redirect::class, Router::REDIRECT],
            [Router::GET, '/redirected', Web\Application\Controller\Contents\Redirected::class, Router::HTML],
            [Router::POST, '/405', Web\Application\Controller\Contents\NotFound::class, Router::JSON]
        ]
    ],
    'view' => [
        'type' => 'twig',
        'templates_path' =>  './src/Infrastructure/Ui/Views/Application',
        'template_file_extension' => 'twig'
    ]
];
