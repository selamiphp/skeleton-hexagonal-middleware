<?php
declare(strict_types=1);

namespace Web\Factory;

use Zend\Config\Config;
use Zend\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig_Environment;
use Selami\View\Twig\Twig as SelamiTwig;
use Selami\View\ViewInterface;

class SelamiViewTwigFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null) : ViewInterface
    {
        $config = $container->get(Config::class);
        $viewConfig = $container->get('view-config')->toArray();
        $request = $container->get(ServerRequestInterface::class);
        if ($config->get('app')->get('view_cache_enabled', false) === true) {
            $viewConfig['cache'] = './cache/view';
        }
        $viewConfig['runtime']['QueryParameters'] =  self::getParams($request);
        $viewConfig['runtime']['BaseUrl'] =  $config['app']['base_url'];
        $viewConfig['runtime']['base_url'] =  $config['app']['base_url']; // To keep BC
        $viewConfig['runtime']['RuntimeConfig'] = $config;
        $viewConfig['runtime']['Request'] = $request;
        $twig = $container->get(Twig_Environment::class);
        return new SelamiTwig($twig, $viewConfig);
    }

    public static function getParams(ServerRequestInterface $request) : array
    {
        $params = $request->getQueryParams();
        $postParams = $request->getParsedBody();
        if ($postParams) {
            $params = array_merge($params, (array)$postParams);
        }
        return $params;
    }
}
