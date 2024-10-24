<?php

namespace App\Http\Controllers\API\Auth;

use App\Constants\AuthConstants;
use App\DTOs\Auth\LoginDTO;
use App\Exceptions\API\V1\Auth\LoginException;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Services\Auth\AuthService;
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
            return $this->sendResponse(data: new LoginResource($result), message: AuthConstants::LOGIN_SUCCESS_MESSAGE);
        } catch (LoginException $e) {
            return $this->sendError(message: $e->getMessage(), code: 401);
        } catch (\Exception $e) {
            return $this->sendError(message: AuthConstants::LOGIN_ERROR_MESSAGE, code: 500);
        }
    }
}
