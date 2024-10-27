<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Auth;

use App\DTOs\Auth\RegisterDTO;
use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\Auth\RegisterException;
use App\Constants\ErrorMessages;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Resources\Auth\RegisterResource;
use App\Services\Auth\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Constants\HttpStatusCodesEnum;

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

            return $this->successResponse(
                RegisterResource::make($result)->resolve(),
                null,
                HttpStatusCodesEnum::CREATED,
                null,
                SuccessCode::REGISTER_SUCCESS
            );
        } catch (RegisterException $e) {
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode(),
                null,
                ErrorCode::REGISTER_FAILED
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
