<?php

declare(strict_types=1);

namespace App\Traits;

use App\Constants\ApiResponseTypeEnum;
use App\Constants\HttpStatusCodesEnum;
use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    protected function successResponse(
        array|object $data,
        ?string $message = null,
        HttpStatusCodesEnum $httpStatusCodesEnum = HttpStatusCodesEnum::OK,
        ?string $redirectUrl = null
    ): JsonResponse {
        $response = [
            'status' => ApiResponseTypeEnum::SUCCESS->value,
            'message' => $message,
            'data' => $data,
        ];

        if ($redirectUrl) {
            $response['redirect_url'] = $redirectUrl;
        }

        return response()->json($response, $httpStatusCodesEnum->value);
    }

    /**
     * @param  array<string, mixed>|null  $errors
     */
    protected function errorResponse(
        string $message,
        HttpStatusCodesEnum $httpStatusCodesEnum = HttpStatusCodesEnum::INTERNAL_SERVER_ERROR,
        ?array $errors = null
    ): JsonResponse {
        $response = [
            'status' => ApiResponseTypeEnum::ERROR->value,
            'message' => $message,
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $httpStatusCodesEnum->value);
    }
}
