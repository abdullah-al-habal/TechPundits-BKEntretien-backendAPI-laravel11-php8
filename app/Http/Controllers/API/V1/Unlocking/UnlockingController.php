<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\Unlocking;

use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\V1\Unlocking\UnlockingNotFoundException;
use App\Exceptions\ErrorMessages;
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

    public function index(): JsonResponse
    {
        try {
            $unlockings = $this->unlockingService->getUnlockings();

            return $this->sendResponse(
                UnlockingResource::collection($unlockings),
                SuccessCode::UNLOCKING_RETRIEVED,
                200
            );
        } catch (UnlockingNotFoundException $e) {
            return $this->sendError($e->getMessage(), $e->getCode(), ErrorCode::UNLOCKING_NOT_FOUND);
        } catch (Exception $e) {
            return $this->sendError(
                ErrorMessages::getMessage(ErrorCode::INTERNAL_SERVER_ERROR),
                500,
                ErrorCode::INTERNAL_SERVER_ERROR
            );
        }
    }
}
