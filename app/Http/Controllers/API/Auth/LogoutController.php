<?php

namespace App\Http\Controllers\API\Auth;

use App\Constants\AuthConstants;
use App\Exceptions\API\V1\Auth\LogoutException;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\API\Auth\LogoutRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;

class LogoutController extends BaseApiController
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    public function logout(LogoutRequest $request): JsonResponse
    {
        try {
            $this->authService->logout($request->user());
            return $this->sendResponse(data: [], message: AuthConstants::LOGOUT_SUCCESS_MESSAGE);
        } catch (LogoutException $e) {
            return $this->sendError(message: $e->getMessage(), code: 500);
        }
    }
}
