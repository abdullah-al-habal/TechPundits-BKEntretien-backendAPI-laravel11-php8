<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\Testimonial;

use App\Constants\HttpStatusCodesEnum;
use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\V1\Testimonial\TestimonialNotFoundException;
use App\Constants\ErrorMessages;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\API\V1\Testimonial\TestimonialResource;
use App\Services\Testimonial\TestimonialService;
use Exception;
use Illuminate\Http\JsonResponse;

class TestimonialController extends BaseApiController
{
    public function __construct(
        private readonly TestimonialService $testimonialService
    ) {}

    /**
     * @OA\Get(
     *     path="/api/v1/testimonials",
     *     summary="Get all testimonials",
     *     description="Retrieve all testimonials",
     *     operationId="getTestimonials",
     *     tags={"Testimonials"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Testimonials retrieved successfully"),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/TestimonialResource")
     *             ),
     *             @OA\Property(property="success_code", type="integer", example=2000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Testimonials not found"
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
            $testimonials = $this->testimonialService->getTestimonials();

            return $this->successResponse(
                TestimonialResource::collection($testimonials),
                null,
                HttpStatusCodesEnum::OK,
                null,
                SuccessCode::TESTIMONIALS_RETRIEVED
            );
        } catch (TestimonialNotFoundException $e) {
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode(),
                null,
                ErrorCode::TESTIMONIAL_NOT_FOUND
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
