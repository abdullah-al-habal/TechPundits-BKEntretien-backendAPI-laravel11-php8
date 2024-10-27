<?php

declare(strict_types=1);

namespace App\Traits;

use App\Constants\ApiResponseTypeEnum;
use App\Constants\HttpStatusCodesEnum;
use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Constants\ErrorMessages;
use App\Constants\SuccessMessages;
use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * Success Response
     */
    protected function successResponse(
        array|object $data,
        ?string $message = null,
        HttpStatusCodesEnum $httpStatusCode = HttpStatusCodesEnum::OK,
        ?string $redirectUrl = null,
        ?SuccessCode $successCode = null
    ): JsonResponse {
        $response = [
            'status' => ApiResponseTypeEnum::SUCCESS->value,
            'success' => true,
            'message' => $message ?? 'Success',
            'data' => $data,
        ];

        if ($redirectUrl) {
            $response['redirect_url'] = $redirectUrl;
        }

        if ($successCode !== null) {
            $response['message'] = SuccessMessages::getMessage($successCode);
            $response['success_code'] = $successCode->value;
        }

        return response()->json($response, $httpStatusCode->value);
    }

    /**
     * Error Response
     */
    protected function errorResponse(
        string $message,
        HttpStatusCodesEnum $httpStatusCode = HttpStatusCodesEnum::BAD_REQUEST,
        ?array $errors = null,
        ?ErrorCode $errorCode = null
    ): JsonResponse {
        $response = [
            'status' => ApiResponseTypeEnum::ERROR->value,
            'success' => false,
            'message' => $message,
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        if ($errorCode !== null) {
            $response['message'] = ErrorMessages::getMessage($errorCode);
            $response['error_code'] = $errorCode->value;
        }

        return response()->json($response, $httpStatusCode->value);
    }
}
