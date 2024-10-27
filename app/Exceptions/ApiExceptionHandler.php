<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Constants\HttpStatusCodesEnum;
use App\Enums\ErrorCode;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ApiExceptionHandler
{
    use ApiResponseTrait;

    public function handle(Throwable $exception, Request $request): JsonResponse
    {
        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse(
                'The requested resource was not found',
                HttpStatusCodesEnum::NOT_FOUND,
                ['route' => ['The requested route does not exist']],
                ErrorCode::RESOURCE_NOT_FOUND
            );
        }

        if ($exception instanceof MethodNotAllowedHttpException) {
            return $this->errorResponse(
                'The request method is not supported for this route',
                HttpStatusCodesEnum::METHOD_NOT_ALLOWED,
                ['method' => ['Method not allowed']],
                ErrorCode::METHOD_NOT_ALLOWED
            );
        }

        if ($exception instanceof ValidationException) {
            return $this->errorResponse(
                'Validation error',
                HttpStatusCodesEnum::UNPROCESSABLE_ENTITY,
                $exception->errors(),
                ErrorCode::VALIDATION_ERROR
            );
        }

        if (config('app.debug')) {
            throw $exception;
        }

        return $this->errorResponse(
            'An unexpected error occurred',
            HttpStatusCodesEnum::INTERNAL_SERVER_ERROR,
            ['server' => ['Internal server error']],
            ErrorCode::INTERNAL_SERVER_ERROR
        );
    }
}
