<?php
declare(strict_types=1);

namespace Web\Middleware;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Selami\Application;
use Zend\Diactoros\Response;
use Zend\Config\Config;
use Selami\Router\Router;

class ApplicationMiddlewareAbstract implements MiddlewareInterface
{
    protected $container;
    protected $config;
    protected static $id;
    protected static $middlewarePath;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $config = require static::$middlewarePath . '/' . static::$id . '-config.php';
        $this->config = new Config($config);
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->container->setService('view-config', $this->config->get('view'));
        $config = $this->config->merge($this->container->get(Config::class));
        $router = Router::createWithServerRequestInterface(
            Router::HTML,
            $request
        );
        $selamiApp = new Application(
            static::$id,
            $this->container,
            $router,
            $config
        );
        return $selamiApp($request, new Response());
    }
}