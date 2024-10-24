<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Auth;

use App\DTOs\Auth\LoginDTO;
use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\Auth\LoginException;
use App\Exceptions\ErrorMessages;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Services\Auth\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;

class LoginController extends BaseApiController
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $loginDTO = LoginDTO::fromRequest(request: $request);
            $result = $this->authService->login(loginDTO: $loginDTO);

            return $this->sendResponse(
                LoginResource::make($result),
                SuccessCode::LOGIN_SUCCESS,
                200
            );
        } catch (LoginException $e) {
            return $this->sendError($e->getMessage(), $e->getCode(), ErrorCode::LOGIN_FAILED);
        } catch (Exception $e) {
            return $this->sendError(
                ErrorMessages::getMessage(ErrorCode::INTERNAL_SERVER_ERROR),
                500,
                ErrorCode::INTERNAL_SERVER_ERROR
            );
        }
    }
}
