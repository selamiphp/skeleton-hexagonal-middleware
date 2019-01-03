<?php
declare(strict_types=1);


namespace Web\Authentication\Controller;

use Symfony\Component\HttpFoundation\Session\Session as SymfonySession;
use Psr\Http\Message\ServerRequestInterface;

abstract class BaseController
{

    /**
     * @var array
     */
    protected $uriParameters;
    /**
     * @var SymfonySession
     */
    protected $session;
    /**
     * @var ServerRequestInterface
     */
    protected $request;
}
