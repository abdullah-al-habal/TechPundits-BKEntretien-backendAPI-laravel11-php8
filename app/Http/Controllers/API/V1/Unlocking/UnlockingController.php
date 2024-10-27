<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\Unlocking;

use App\Constants\HttpStatusCodesEnum;
use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\V1\Unlocking\UnlockingNotFoundException;
use App\Constants\ErrorMessages;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\API\V1\Unlocking\UnlockingResource;
use App\Services\Unlocking\UnlockingService;
use Exception;
use Illuminate\Http\JsonResponse;

class UnlockingController extends BaseApiController
{
    public function __construct(
        private readonly UnlockingService $unlockingService
    ) {}

    /**
     * @OA\Get(
     *     path="/api/v1/unlockings",
     *     summary="Get all unlockings",
     *     description="Retrieve a list of all unlockings",
     *     operationId="getUnlockings",
     *     tags={"Unlocking"},
     *     security={{"bearerAuth": {}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Unlockings retrieved successfully"),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/UnlockingResource")),
     *             @OA\Property(property="success_code", type="integer", example=2000)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Unlockings not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Unlockings not found"),
     *             @OA\Property(property="error_code", type="integer", example=4040)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Internal server error"),
     *             @OA\Property(property="error_code", type="integer", example=5000)
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $unlockings = $this->unlockingService->getUnlockings();

            return $this->successResponse(
                UnlockingResource::collection($unlockings)->resolve(),
                null,
                HttpStatusCodesEnum::OK,
                null,
                SuccessCode::UNLOCKING_RETRIEVED
            );
        } catch (UnlockingNotFoundException $e) {
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode(),
                null,
                ErrorCode::UNLOCKING_NOT_FOUND
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
