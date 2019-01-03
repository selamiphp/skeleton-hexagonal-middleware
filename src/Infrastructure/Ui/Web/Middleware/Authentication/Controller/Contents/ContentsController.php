<?php
declare(strict_types=1);


namespace Web\Authentication\Controller\Contents;

use Web\Authentication\Controller\BaseController;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Config\Config;

abstract class ContentsController extends BaseController
{
    protected $config;

    public function __construct(
        Config $config,
        ServerRequestInterface $request,
        array $uriParameters
    ) {
        $this->request = $request;
        $this->uriParameters = $uriParameters;
        $this->config = $config;
    }
}
