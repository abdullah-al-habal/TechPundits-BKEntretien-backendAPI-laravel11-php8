<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Auth;

use App\Constants\HttpStatusCodesEnum;
use App\DTOs\Auth\LoginDTO;
use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\Auth\LoginException;
use App\Constants\ErrorMessages;
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

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="User login",
     *     description="Authenticate user and return token",
     *     operationId="login",
     *     tags={"Authentication"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"email","password"},
     *
     *             @OA\Property(property="email", type="string", format="email"),
     *             @OA\Property(property="password", type="string", format="password"),
     *             @OA\Property(property="device_name", type="string")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful login",
     *
     *         @OA\JsonContent(ref="#/components/schemas/LoginResource")
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $loginDTO = LoginDTO::fromRequest(request: $request);
            $result = $this->authService->login(loginDTO: $loginDTO);

            return $this->successResponse(
                LoginResource::make($result)->resolve(),
                null,
                HttpStatusCodesEnum::OK,
                null,
                SuccessCode::LOGIN_SUCCESS
            );
        } catch (LoginException $e) {
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode(),
                null,
                ErrorCode::LOGIN_FAILED
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
