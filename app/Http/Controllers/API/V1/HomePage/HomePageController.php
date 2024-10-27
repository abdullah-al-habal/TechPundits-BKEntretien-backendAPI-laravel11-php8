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

class HomePageController extends BaseApiController
{
    public function __construct(
        private readonly HomePageService $homePageService
    ) {}

    /**
     * @OA\Get(
     *     path="/api/v1/home",
     *     summary="Get home page data",
     *     description="Retrieve the home page data",
     *     operationId="getHomePage",
     *     tags={"Home Page"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *
     *         @OA\JsonContent(ref="#/components/schemas/HomePageResource")
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Home page not found"
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
            $homePage = $this->homePageService->getHomePage();

            return $this->successResponse(
                new HomePageResource($homePage),
                null,
                HttpStatusCodesEnum::OK,
                null,
                SuccessCode::HOME_PAGE_RETRIEVED
            );
        } catch (HomePageNotFoundException $e) {
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode(),
                null,
                ErrorCode::HOME_PAGE_NOT_FOUND
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
