<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\DrainCleaning;

use App\Constants\HttpStatusCodesEnum;
use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\V1\DrainCleaning\DrainCleaningNotFoundException;
use App\Constants\ErrorMessages;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\API\V1\DrainCleaning\DrainCleaningResource;
use App\Services\DrainCleaning\DrainCleaningService;
use Exception;
use Illuminate\Http\JsonResponse;

class DrainCleaningController extends BaseApiController
{
    public function __construct(
        private readonly DrainCleaningService $drainCleaningService
    ) {}

    /**
     * @OA\Get(
     *     path="/api/v1/drain-cleaning",
     *     summary="Get drain cleaning list",
     *     description="Retrieve a list of drain cleaning records",
     *     operationId="getDrainCleanings",
     *     tags={"Drain Cleaning"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/DrainCleaningResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Drain cleaning records not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $drainCleanings = $this->drainCleaningService->getDrainCleanings();

            return $this->successResponse(
                DrainCleaningResource::collection($drainCleanings)->resolve(),
                null,
                HttpStatusCodesEnum::OK,
                null,
                SuccessCode::DRAIN_CLEANING_RETRIEVED
            );
        } catch (DrainCleaningNotFoundException $e) {
            return $this->errorResponse(
                $e->getMessage(),
                HttpStatusCodesEnum::NOT_FOUND,
                null,
                ErrorCode::DRAIN_CLEANING_NOT_FOUND
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
