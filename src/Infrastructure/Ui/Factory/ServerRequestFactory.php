<?php
declare(strict_types=1);

namespace Web\Factory;

use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\ServerRequestFactory as DiactorosServerRequestFactory;

class ServerRequestFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : ServerRequestInterface
    {
        return DiactorosServerRequestFactory::fromGlobals();
    }
}
