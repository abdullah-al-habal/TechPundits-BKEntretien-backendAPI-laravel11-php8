<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\SiteSetting;

use App\Constants\HttpStatusCodesEnum;
use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\V1\SiteSetting\SiteSettingNotFoundException;
use App\Constants\ErrorMessages;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\API\V1\SiteSetting\SiteSettingResource;
use App\Services\SiteSetting\SiteSettingService;
use Exception;
use Illuminate\Http\JsonResponse;

class SiteSettingController extends BaseApiController
{
    public function __construct(
        private readonly SiteSettingService $siteSettingService
    ) {}

    /**
     * @OA\Get(
     *     path="/api/v1/site-settings",
     *     summary="Get all site settings",
     *     description="Retrieve all site settings",
     *     operationId="getSiteSettings",
     *     tags={"Site Settings"},
     *     security={{"bearerAuth": {}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Site settings retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/SiteSettingResource")
     *             ),
     *             @OA\Property(property="success_code", type="integer", example=2000)
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Site settings not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Site settings not found"),
     *             @OA\Property(property="error_code", type="integer", example=4004)
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
            $settings = $this->siteSettingService->getAllSettings();

            return $this->successResponse(
                SiteSettingResource::collection($settings)->resolve(),
                null,
                HttpStatusCodesEnum::OK,
                null,
                SuccessCode::SITE_SETTINGS_RETRIEVED
            );
        } catch (SiteSettingNotFoundException $e) {
            return $this->errorResponse(
                $e->getMessage(),
                HttpStatusCodesEnum::NOT_FOUND,
                null,
                ErrorCode::SITE_SETTING_NOT_FOUND
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
