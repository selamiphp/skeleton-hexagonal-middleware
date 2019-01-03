<?php
declare(strict_types=1);

require_once 'vendor/autoload.php';

use Selami\Console\ApplicationFactory;
use Zend\ServiceManager\ServiceManager;
use Zend\Config\Config;

$config = require  __DIR__ . '/config.php';
$container = new ServiceManager($config['dependencies']);
$container->setService(Config::class, new Config($config));
$container->setService(
    'commands', $config['commands']
);
$cli = ApplicationFactory::makeApplication($container);
$cli->run();