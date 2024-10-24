<?php

namespace App\Http\Controllers\API;

use App\Exceptions\SuccessMessages;
use App\Enums\SuccessCode;
use App\Enums\ErrorCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseApiController extends Controller
{
    /**
     * Send a success response.
     *
     * @param  mixed  $data
     * @param  SuccessCode|null  $successCode
     * @param  int  $code
     * @return JsonResponse
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
     *
     * @param  string  $message
     * @param  int  $code
     * @param  ErrorCode|null  $errorCode
     * @param  array|string|null  $errors
     * @return JsonResponse
     */
    protected function sendError(
        string $message,
        int $code = 400,
        ?ErrorCode $errorCode = null,
        array|string|null $errors = null
    ): JsonResponse {

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
