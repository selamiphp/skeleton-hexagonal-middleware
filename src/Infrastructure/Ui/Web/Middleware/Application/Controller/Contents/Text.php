<?php
declare(strict_types=1);

namespace Web\Application\Controller\Contents;

use Selami\Interfaces\ApplicationController;
use Selami\ControllerResponse;

class Text extends ContentsController implements ApplicationController
{
    public function __invoke() : ControllerResponse
    {
        return ControllerResponse::TEXT(
            200,
            [
                't' => self::class
            ]
        );
    }
}
