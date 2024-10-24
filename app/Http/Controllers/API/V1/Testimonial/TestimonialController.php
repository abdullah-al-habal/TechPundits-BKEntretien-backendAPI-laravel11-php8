<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\Testimonial;

use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\V1\Testimonial\TestimonialNotFoundException;
use App\Exceptions\ErrorMessages;
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

    public function index(): JsonResponse
    {
        try {
            $testimonials = $this->testimonialService->getTestimonials();

            return $this->sendResponse(
                TestimonialResource::collection($testimonials),
                SuccessCode::TESTIMONIALS_RETRIEVED,
                200
            );
        } catch (TestimonialNotFoundException $e) {
            return $this->sendError($e->getMessage(), $e->getCode(), ErrorCode::TESTIMONIAL_NOT_FOUND);
        } catch (Exception $e) {
            return $this->sendError(ErrorMessages::getMessage(ErrorCode::INTERNAL_SERVER_ERROR), 500, ErrorCode::INTERNAL_SERVER_ERROR);
        }
    }
}
