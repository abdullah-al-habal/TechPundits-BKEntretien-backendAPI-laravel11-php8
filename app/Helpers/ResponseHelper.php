<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    /**
     * Return a success JSON response.
     *
     * @param array  $data    Data to include in the response
     * @param string $message Success message
     * @param int    $status  HTTP status code
     */
    public static function success(array $data = [], string $message = 'Success', int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    /**
     * Return an error JSON response.
     *
     * @param string $message Error message
     * @param array  $errors  Errors to include in the response
     * @param int    $status  HTTP status code
     */
    public static function error(string $message = 'Error', array $errors = [], int $status = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}
