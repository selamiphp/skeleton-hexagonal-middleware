<?php
declare(strict_types=1);


namespace Web\Authentication\Controller\Contents;

use Selami\Interfaces\ApplicationController;
use Selami\ControllerResponse;

class Category extends ContentsController implements ApplicationController
{
    public function __invoke() : ControllerResponse
    {
        return ControllerResponse::HTML(
            200,
            [
                't' => self::class,
                'uriParameter' => $this->uriParameters['category']
            ]
        );
    }
}
