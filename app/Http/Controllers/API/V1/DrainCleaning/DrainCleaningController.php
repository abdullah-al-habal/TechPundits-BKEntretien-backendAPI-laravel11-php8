<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\DrainCleaning;

use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\V1\DrainCleaning\DrainCleaningNotFoundException;
use App\Exceptions\ErrorMessages;
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

    public function index(): JsonResponse
    {
        try {
            $drainCleanings = $this->drainCleaningService->getDrainCleanings();

            return $this->sendResponse(
                DrainCleaningResource::collection($drainCleanings),
                SuccessCode::DRAIN_CLEANING_RETRIEVED,
                200
            );
        } catch (DrainCleaningNotFoundException $e) {
            return $this->sendError($e->getMessage(), $e->getCode(), ErrorCode::DRAIN_CLEANING_NOT_FOUND);
        } catch (Exception $e) {
            return $this->sendError(
                ErrorMessages::getMessage(ErrorCode::INTERNAL_SERVER_ERROR),
                500,
                ErrorCode::INTERNAL_SERVER_ERROR
            );
        }
    }
}
