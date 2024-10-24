<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\HomePage;

use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\V1\HomePage\HomePageNotFoundException;
use App\Exceptions\ErrorMessages;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\API\V1\HomePage\HomePageResource;
use App\Services\HomePage\HomePageService;
use Exception;
use Illuminate\Http\JsonResponse;

class HomePageController extends BaseApiController
{
    public function __construct(
        private readonly HomePageService $homePageService
    ) {}

    public function index(): JsonResponse
    {
        try {
            $homePage = $this->homePageService->getHomePage();

            return $this->sendResponse(
                new HomePageResource($homePage),
                SuccessCode::HOME_PAGE_RETRIEVED,
                200
            );
        } catch (HomePageNotFoundException $e) {
            return $this->sendError($e->getMessage(), $e->getCode(), ErrorCode::HOME_PAGE_NOT_FOUND);
        } catch (Exception $e) {
            return $this->sendError(ErrorMessages::getMessage(ErrorCode::INTERNAL_SERVER_ERROR), 500, ErrorCode::INTERNAL_SERVER_ERROR);
        }
    }
}
