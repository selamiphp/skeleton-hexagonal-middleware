<?php
declare(strict_types=1);

namespace Web\Middleware\Authentication;

use Web\Middleware\ApplicationMiddlewareAbstract;

class Middleware extends ApplicationMiddlewareAbstract
{
    protected static $id = 'middleware-authentication';
    protected static $middlewarePath = __DIR__;
}