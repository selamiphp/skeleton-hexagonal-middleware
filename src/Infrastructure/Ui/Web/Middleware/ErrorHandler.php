<?php
declare(strict_types=1);

namespace Web\Middleware;

use Selami\ControllerResponse;
use Selami\Interfaces\ApplicationController;

class ErrorHandler implements ApplicationController
{
    private $status;
    private $message;

    public function __construct(int $status, string $message)
    {
        $this->status = $status;
        $this->message = $message;
    }

    public function __invoke(): ControllerResponse
    {
        return ControllerResponse::HTML(
            $this->status,
            [
                'status' => $this->status,
                'message' => $this->message,
            ],
            [
                'layout' => 'error_handler'
            ]
        );
    }
}
