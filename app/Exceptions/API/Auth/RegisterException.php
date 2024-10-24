<?php

namespace App\Exceptions\API\V1\Auth;

use Exception;
use Illuminate\Http\JsonResponse;

class RegisterException extends Exception
{
    public function __construct(string $message = "Failed to register", int $code = 500, ?\Throwable $previous = null)
    {
        parent::__construct(message: $message, code: $code, previous: $previous);
    }

    public function render($request): JsonResponse
    {
        return response()->json(data: ['error' => $this->getMessage()], status: $this->getCode());
    }
}
