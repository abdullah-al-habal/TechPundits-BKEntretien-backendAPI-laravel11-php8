<?php

namespace App\Http\Controllers\API\V1\SiteSetting;

use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\V1\SiteSetting\SiteSettingNotFoundException;
use App\Exceptions\ErrorMessages;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\API\V1\SiteSetting\SiteSettingResource;
use App\Services\SiteSetting\SiteSettingService;
use Illuminate\Http\JsonResponse;

class SiteSettingController extends BaseApiController
{
    public function __construct(
        private readonly SiteSettingService $siteSettingService
    ) {}

    public function index(): JsonResponse
    {
        try {
            $settings = $this->siteSettingService->getAllSettings();
            return $this->sendResponse(
                data: SiteSettingResource::collection($settings),
                successCode: SuccessCode::SITE_SETTINGS_RETRIEVED,
                code: 200
            );
        } catch (SiteSettingNotFoundException $e) {
            return $this->sendError(message: $e->getMessage(), code: $e->getCode(), errorCode: ErrorCode::SITE_SETTING_NOT_FOUND);
        } catch (\Exception $e) {
            return $this->sendError(message: ErrorMessages::getMessage(ErrorCode::INTERNAL_SERVER_ERROR), code: 500, errorCode: ErrorCode::INTERNAL_SERVER_ERROR);
        }
    }
}
