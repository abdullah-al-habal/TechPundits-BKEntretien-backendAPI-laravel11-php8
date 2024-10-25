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
     * @param  mixed  $data
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

        if ($successCode !== null) {
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

        if ($errorCode !== null) {
            $message = ErrorMessages::getMessage($errorCode);
        }

        $response = [
            'success' => false,
            'message' => $message,
            'status' => $code,
        ];

        if ($errorCode !== null) {
            $response['error_code'] = $errorCode->value;
        }

        if ($errors !== null) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}
