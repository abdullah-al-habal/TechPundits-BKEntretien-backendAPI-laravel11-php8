<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\Faq;

use App\Constants\HttpStatusCodesEnum;
use App\Contracts\FaqServiceInterface;
use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\V1\Faq\FaqNotFoundException;
use App\Constants\ErrorMessages;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\API\V1\Faq\FaqResource;
use Exception;
use Illuminate\Http\JsonResponse;

class FaqController extends BaseApiController
{
    public function __construct(
        private readonly FaqServiceInterface $faqService
    ) {}

    /**
     * @OA\Get(
     *     path="/api/v1/faqs",
     *     summary="Get all FAQs",
     *     description="Retrieve a list of all FAQs",
     *     operationId="getFaqs",
     *     tags={"FAQ"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="FAQs retrieved successfully"),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/FaqResource")),
     *             @OA\Property(property="success_code", type="integer", example=2000)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="FAQs not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="FAQs not found"),
     *             @OA\Property(property="error_code", type="integer", example=4040)
     *         )
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
            $faqs = $this->faqService->getFaqs();

            return $this->successResponse(
                FaqResource::collection($faqs),
                null,
                HttpStatusCodesEnum::OK,
                null,
                SuccessCode::FAQS_RETRIEVED
            );
        } catch (FaqNotFoundException $e) {
            return $this->errorResponse(
                $e->getMessage(),
                HttpStatusCodesEnum::NOT_FOUND,
                null,
                ErrorCode::FAQ_NOT_FOUND
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
