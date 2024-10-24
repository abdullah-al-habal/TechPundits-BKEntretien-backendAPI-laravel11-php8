<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\ErrorCode;
use Exception;
use Illuminate\Http\JsonResponse;

abstract class BaseHttpException extends Exception
{
    public function __construct(
        public ErrorCode $errorCode,
        int $httpStatus,
        ?string $message = null,
        public ?array $data = null
    ) {
        $message = $message ?? ErrorMessages::getMessage($errorCode);
        parent::__construct($message, $httpStatus);
    }

    public function render($request): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
            'code' => $this->errorCode->value,
            'data' => $this->data,
        ], $this->getCode());
    }
}
