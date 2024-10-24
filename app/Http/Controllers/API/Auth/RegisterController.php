<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Auth;

use App\DTOs\Auth\RegisterDTO;
use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\Auth\RegisterException;
use App\Exceptions\ErrorMessages;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Resources\Auth\RegisterResource;
use App\Services\Auth\AuthService;
use Exception;
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

            return $this->sendResponse(
                RegisterResource::make($result),
                SuccessCode::REGISTER_SUCCESS,
                201
            );
        } catch (RegisterException $e) {
            return $this->sendError(
                $e->getMessage(),
                $e->getCode(),
                ErrorCode::REGISTER_FAILED
            );
        } catch (Exception $e) {
            return $this->sendError(
                ErrorMessages::getMessage(ErrorCode::INTERNAL_SERVER_ERROR),
                500,
                ErrorCode::INTERNAL_SERVER_ERROR
            );
        }
    }
}
