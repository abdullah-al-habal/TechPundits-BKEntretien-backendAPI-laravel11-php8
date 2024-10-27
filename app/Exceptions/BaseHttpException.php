<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Constants\ErrorMessages;
use App\Enums\ErrorCode;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class BaseHttpException extends Exception
{
    public function __construct(
        public ErrorCode $errorCode,
        int $httpStatus,
        ?string $message = null,
        public ?array $data = null
    ) {
        $message ??= ErrorMessages::getMessage($errorCode);
        parent::__construct($message, $httpStatus);
    }

    public function getHttpStatus(): int
    {
        return $this->getCode();
    }

    public function getErrorCode(): ErrorCode
    {
        return $this->errorCode;
    }

    public function getData(): ?array
    {
        return $this->data;
    }

    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'message' => $this->getMessage(),
            'code' => $this->errorCode->value,
            'data' => $this->data,
        ], $this->getCode());
    }
}
