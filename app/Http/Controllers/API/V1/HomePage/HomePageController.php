<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\HomePage;

use App\Constants\HttpStatusCodesEnum;
use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\V1\HomePage\HomePageNotFoundException;
use App\Constants\ErrorMessages;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\API\V1\HomePage\HomePageResource;
use App\Services\HomePage\HomePageService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class HomePageController extends BaseApiController
{
    public function __construct(
        private readonly HomePageService $homePageService,
    ) {}

    /**
     * @OA\Get(
     *     path="/api/v1/home",
     *     summary="Get home page data",
     *     description="Retrieve the home page data",
     *     operationId="getHomePage",
     *     tags={"Home Page"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/HomePageResource")
     *     ),
     *     @OA\Response(response=404, description="Home page not found"),
     *     @OA\Response(response=500, description="Internal server error")
     * )
     */
    public function getHomePageData(): JsonResponse
    {
        try {
            $homePage = $this->homePageService->fetchHomePageData();

            return $this->successResponse(
                new HomePageResource($homePage),
                null,
                HttpStatusCodesEnum::OK,
                null,
                SuccessCode::HOME_PAGE_RETRIEVED
            );
        } catch (HomePageNotFoundException $e) {
            Log::warning('HomePage not found: ' . $e->getMessage());
            return $this->errorResponse(
                $e->getMessage(),
                HttpStatusCodesEnum::NOT_FOUND,
                null,
                ErrorCode::HOME_PAGE_NOT_FOUND,
                $e->getMessage()
            );
        } catch (Exception $e) {
            Log::error('Error retrieving home page: ' . $e->getMessage());
            return $this->errorResponse(
                ErrorMessages::getMessage(ErrorCode::INTERNAL_SERVER_ERROR),
                HttpStatusCodesEnum::INTERNAL_SERVER_ERROR,
                null,
                ErrorCode::INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }
    }
}
