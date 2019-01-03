<?php
declare(strict_types=1);

namespace Web\Authentication\Controller\Contents;

use Selami\ControllerResponse;
use Selami\Interfaces\ApplicationController;

class CamelCase extends ContentsController implements ApplicationController
{
    public function __invoke() : ControllerResponse
    {
        return ControllerResponse::HTML(
            200,
            [
                't' => self::class
            ]
        );
    }
}
