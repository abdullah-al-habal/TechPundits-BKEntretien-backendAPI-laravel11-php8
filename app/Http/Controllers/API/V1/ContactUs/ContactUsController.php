<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\ContactUs;

use App\Constants\HttpStatusCodesEnum;
use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\V1\ContactUs\ContactUsNotFoundException;
use App\Constants\ErrorMessages;
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

    /**
     * @OA\Get(
     *     path="/api/v1/contact-us",
     *     summary="Get contact information",
     *     description="Retrieve contact information",
     *     operationId="getContactInfo",
     *     tags={"Contact Us"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Contact information retrieved successfully"),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/ContactUsResource")),
     *             @OA\Property(property="success_code", type="integer", example=2000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Contact information not found"
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
            $contactInfo = $this->contactUsService->getContactInfo();

            return $this->successResponse(
                ContactUsResource::collection($contactInfo)->resolve(),
                null,
                HttpStatusCodesEnum::OK,
                null,
                SuccessCode::CONTACT_US_RETRIEVED
            );
        } catch (ContactUsNotFoundException $e) {
            return $this->errorResponse(
                $e->getMessage(),
                HttpStatusCodesEnum::NOT_FOUND,
                null,
                ErrorCode::CONTACT_US_NOT_FOUND,
                $e->getMessage()
            );
        } catch (Exception $e) {
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
