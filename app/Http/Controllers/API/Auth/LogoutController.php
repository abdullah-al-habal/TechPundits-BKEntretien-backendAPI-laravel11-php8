<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Auth;

use App\Constants\HttpStatusCodesEnum;
use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\Auth\LogoutException;
use App\Constants\ErrorMessages;
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

            return $this->successResponse(
                [],
                null,
                HttpStatusCodesEnum::OK,
                null,
                SuccessCode::LOGOUT_SUCCESS
            );
        } catch (LogoutException $e) {
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode(),
                null,
                ErrorCode::LOGOUT_FAILED
            );
        } catch (Exception $e) {
            return $this->errorResponse(
                ErrorMessages::getMessage(ErrorCode::INTERNAL_SERVER_ERROR),
                HttpStatusCodesEnum::INTERNAL_SERVER_ERROR,
                null,
                ErrorCode::INTERNAL_SERVER_ERROR
            );
        }
    }
}
