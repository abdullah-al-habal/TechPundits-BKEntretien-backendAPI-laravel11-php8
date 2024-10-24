<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\ContactUs;

use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\V1\ContactUs\ContactUsNotFoundException;
use App\Exceptions\ErrorMessages;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\API\V1\ContactUs\ContactUsResource;
use App\Services\ContactUs\ContactUsService;
use Exception;
use Illuminate\Http\JsonResponse;

class ContactUsController extends BaseApiController
{
    public function __construct(
        private readonly ContactUsService $contactUsService
    ) {}

    public function index(): JsonResponse
    {
        try {
            $contactInfo = $this->contactUsService->getContactInfo();

            return $this->sendResponse(
                ContactUsResource::collection($contactInfo),
                SuccessCode::CONTACT_US_RETRIEVED,
                200
            );
        } catch (ContactUsNotFoundException $e) {
            return $this->sendError($e->getMessage(), $e->getCode(), ErrorCode::CONTACT_US_NOT_FOUND);
        } catch (Exception $e) {
            return $this->sendError(
                // ErrorMessages::getMessage(ErrorCode::INTERNAL_SERVER_ERROR),
                $e->getMessage(),
                500,
                ErrorCode::INTERNAL_SERVER_ERROR
            );
        }
    }
}
