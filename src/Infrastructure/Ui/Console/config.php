<?php
declare(strict_types=1);

use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\Glob;


$dotenv = new Dotenv\Dotenv('./');
$dotenv->load();
$config = [];
foreach (Glob::glob (
    './config/autoload/{console/{,*.}global,console/{,*.}local,{,*.}global,{,*.}local}.php',
    Glob::GLOB_BRACE
    ) as $file) {
    $config = ArrayUtils::merge($config, include $file);
}

return $config;
