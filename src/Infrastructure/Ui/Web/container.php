<?php
declare(strict_types=1);

use Zend\ServiceManager\ServiceManager;
use Zend\Config\Config;
use Selami\Stdlib\BaseUrlExtractor;

$config = include __DIR__ . '/config.php';
$config['app']['base_url'] = BaseUrlExtractor::getBaseUrl($_SERVER);
$container = new ServiceManager($config['dependencies']);
$container->setService(Config::class, new Config($config));
return $container;
