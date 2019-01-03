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
        'middleware-authentication' =>[
            [Router::GET, '', Web\Authentication\Controller\Contents\Main::class, Router::HTML, 'home'],
            [Router::GET, '/', Web\Authentication\Controller\Contents\Main::class, Router::HTML, 'home'],
            [Router::GET, '/category/{category}', Web\Authentication\Controller\Contents\Category::class, Router::HTML, 'category'],
            [Router::GET, '/{year}/{month}/{slug}', Web\Authentication\Controller\Contents\Post::class, Router::JSON, 'post'],
            [Router::GET, '/download', Web\Authentication\Controller\Contents\Download::class, Router::DOWNLOAD],
            [Router::GET, '/text', Web\Authentication\Controller\Contents\Text::class, Router::TEXT],
            [Router::GET, '/custom', Web\Authentication\Controller\Contents\Custom::class, Router::CUSTOM],
            [Router::GET, '/redirect', Web\Authentication\Controller\Contents\Redirect::class, Router::REDIRECT],
            [Router::GET, '/redirected', Web\Authentication\Controller\Contents\Redirected::class, Router::HTML],
            [Router::POST, '/405', Web\Authentication\Controller\Contents\NotFound::class, Router::JSON]
        ]
    ],
    'view' => [
        'type' => 'twig',
        'templates_path' =>  './src/Infrastructure/Ui/Views/Authentication',
        'template_file_extension' => 'twig'
    ]
];
