<?php
declare(strict_types=1);

namespace Web\Application\Controller\Contents;

use Selami\Interfaces\ApplicationController;
use Selami\ControllerResponse;

class Post extends ContentsController implements ApplicationController
{
    public function __invoke() : ControllerResponse
    {
        $count = 1;
        return ControllerResponse::JSON(
            200,
            [
                'controller-class' => self::class,
                'uri-parameters' => $this->uriParameters,
                'session-count-value' => $count,
                'data' => $this->request->getAttributes()
            ]
        );
    }
}
