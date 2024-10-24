<?php

namespace App\Http\Controllers\API\Auth;

use App\Constants\AuthConstants;
use App\DTOs\Auth\RegisterDTO;
use App\Exceptions\API\V1\Auth\RegisterException;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Resources\Auth\RegisterResource;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;

class RegisterController extends BaseApiController
{
    public function __construct(
        private readonly AuthService $authService
    ) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $registerDTO = RegisterDTO::fromRequest(request: $request);
            $result = $this->authService->register(registerDTO: $registerDTO);
            return $this->sendResponse(data: new RegisterResource(resource: $result), message: AuthConstants::REGISTER_SUCCESS_MESSAGE, code: 201);
        } catch (RegisterException $e) {
            return $this->sendError(message: $e->getMessage(), code: $e->getCode());
        } catch (\Exception $e) {
            return $this->sendError(message: AuthConstants::REGISTER_ERROR_MESSAGE, code: 500);
        }
    }
}
