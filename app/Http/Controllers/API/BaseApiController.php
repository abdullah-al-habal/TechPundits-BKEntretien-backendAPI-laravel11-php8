<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\ErrorMessages;
use App\Exceptions\SuccessMessages;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseApiController extends Controller
{
    /**
     * Send a success response.
     *
     * @param mixed $data
     */
    protected function sendResponse(
        $data,
        ?SuccessCode $successCode = null,
        int $code = 200
    ): JsonResponse {
        $response = [
            'success' => true,
            'data' => $data,
            'status' => $code,
        ];

        if (null !== $successCode) {
            $response['message'] = SuccessMessages::getMessage($successCode);
            $response['success_code'] = $successCode->value;
        }

        return response()->json($response, $code);
    }

    /**
     * Send an error response.
     */
    protected function sendError(
        string $message,
        int $code = 400,
        ?ErrorCode $errorCode = null,
        null|array|string $errors = null
    ): JsonResponse {

        if (null !== $errorCode) {
            $message = ErrorMessages::getMessage($errorCode);
        }

        $response = [
            'success' => false,
            'message' => $message,
            'status' => $code,
        ];

        if (null !== $errorCode) {
            $response['error_code'] = $errorCode->value;
        }

        if (null !== $errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}
