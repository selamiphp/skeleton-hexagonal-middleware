<?php
declare(strict_types=1);

namespace Web\Authentication\Controller\Contents;

use Selami\Interfaces\ApplicationController;
use Selami\ControllerResponse;

class Main extends ContentsController implements ApplicationController
{
    public function __invoke() : ControllerResponse
    {
        return ControllerResponse::HTML(
            200,
            [
                't' => self::class,
                'auth' => json_encode($this->request->getAttributes())
            ]
        );
    }
}
