<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Constants\ApiResponseTypeEnum;
use App\Constants\HttpStatusCodesEnum;
use App\Constants\SuccessMessages;
use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Constants\ErrorMessages;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Your API Documentation",
 *     description="API documentation for Your Application",
 *
 *     @OA\Contact(
 *         email="your-email@example.com"
 *     )
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="API Server"
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT"
 * )
 */
class BaseApiController extends Controller
{
    /**
     * Success Response
     */
    protected function successResponse(
        array|object $data,
        ?string $message = null,
        int|HttpStatusCodesEnum $httpStatusCode = HttpStatusCodesEnum::OK,
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

        // Convert HttpStatusCodesEnum to int if necessary
        $statusCode = $httpStatusCode instanceof HttpStatusCodesEnum
            ? $httpStatusCode->value
            : $httpStatusCode;

        return response()->json($response, $statusCode);
    }

    /**
     * Error Response
     */
    protected function errorResponse(
        string $message,
        int|HttpStatusCodesEnum $httpStatusCode = HttpStatusCodesEnum::BAD_REQUEST,
        ?array $errors = null,
        ?ErrorCode $errorCode = null,
        ?string $actualErrorMessage = null // New parameter for actual error message
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
            $response['error_code'] = $errorCode->value;
            $response['message'] = ErrorMessages::getMessage($errorCode);
        }

        // Include the actual error message if provided
        if ($actualErrorMessage) {
            $response['actual_error_message'] = $actualErrorMessage; // Add actual error message to response
        }

        // Convert HttpStatusCodesEnum to int if necessary
        $statusCode = $httpStatusCode instanceof HttpStatusCodesEnum
            ? $httpStatusCode->value
            : $httpStatusCode;

        return response()->json($response, $statusCode);
    }
}
