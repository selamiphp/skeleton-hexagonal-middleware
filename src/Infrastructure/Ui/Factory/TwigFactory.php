<?php
declare(strict_types=1);

namespace Web\Factory;

use Zend\Config\Config;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class TwigFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : Environment
    {
        $config = $container->get(Config::class);
        $twigConfig = $container->get('view-config')->toArray();

        if ($config->get('app')->get('config_cache_enabled') === true) {
            $twigConfig['cache'] = $config->get('app')->get('cache_dir').'/view';
        }
        $loader = new FilesystemLoader($twigConfig['templates_path']);
        return new Environment($loader, $twigConfig);
    }
}
