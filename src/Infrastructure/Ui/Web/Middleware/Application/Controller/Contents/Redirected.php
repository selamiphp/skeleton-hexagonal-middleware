<?php
declare(strict_types=1);

namespace Web\Application\Controller\Contents;

use Selami\Interfaces\ApplicationController;
use Selami\ControllerResponse;

class Redirected extends ContentsController implements ApplicationController
{
    public function __invoke() : ControllerResponse
    {
        return ControllerResponse::HTML(
            200,
            [
                't' => self::class,
                'referer' => $this->request->getServerParams()['HTTP_REFERER']
            ]
        );
    }
}
