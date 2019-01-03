<?php
declare(strict_types=1);

namespace Web\Application\Controller\Contents;

use Selami\Interfaces\ApplicationController;
use Selami\ControllerResponse;

class Redirect extends ContentsController implements ApplicationController
{
    public function __invoke() : ControllerResponse
    {
        return ControllerResponse::REDIRECT(302, '/redirected');
    }
}
