<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Auth;

use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\Auth\LogoutException;
use App\Exceptions\ErrorMessages;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\API\Auth\LogoutRequest;
use App\Services\Auth\AuthService;
use Exception;
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

            return $this->sendResponse(
                [],
                SuccessCode::LOGOUT_SUCCESS,
                200
            );
        } catch (LogoutException $e) {
            return $this->sendError($e->getMessage(), $e->getCode(), ErrorCode::LOGOUT_FAILED);
        } catch (Exception $e) {
            return $this->sendError(ErrorMessages::getMessage(ErrorCode::INTERNAL_SERVER_ERROR), 500, ErrorCode::INTERNAL_SERVER_ERROR);
        }
    }
}
