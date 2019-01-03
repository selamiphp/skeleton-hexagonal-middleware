<?php
declare(strict_types=1);

namespace Web\Factory;

use Selami\Router\Router;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

class RouterFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : Router
    {
        $request = $container->get(ServerRequestInterface::class);
        return Router::createWithServerRequestInterface(
            Router::HTML,
            $request
        );

    }
}
