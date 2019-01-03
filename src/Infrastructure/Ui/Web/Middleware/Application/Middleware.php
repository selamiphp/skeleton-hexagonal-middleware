<?php
declare(strict_types=1);

namespace Web\Middleware\Application;

use Web\Middleware\ApplicationMiddlewareAbstract;

class Middleware extends ApplicationMiddlewareAbstract
{
    protected static $id = 'middleware-main-application';
    protected static $middlewarePath = __DIR__;
}