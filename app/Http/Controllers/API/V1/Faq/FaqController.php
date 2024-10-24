<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\Faq;

use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\V1\Faq\FaqNotFoundException;
use App\Exceptions\ErrorMessages;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\API\V1\Faq\FaqResource;
use App\Services\Faq\FaqService;
use Exception;
use Illuminate\Http\JsonResponse;

class FaqController extends BaseApiController
{
    public function __construct(
        private readonly FaqService $faqService
    ) {}

    public function index(): JsonResponse
    {
        try {
            $faqs = $this->faqService->getFaqs();

            return $this->sendResponse(
                FaqResource::collection($faqs),
                SuccessCode::FAQS_RETRIEVED,
                200
            );
        } catch (FaqNotFoundException $e) {
            return $this->sendError($e->getMessage(), $e->getCode(), ErrorCode::FAQ_NOT_FOUND);
        } catch (Exception $e) {
            return $this->sendError(ErrorMessages::getMessage(ErrorCode::INTERNAL_SERVER_ERROR), 500, ErrorCode::INTERNAL_SERVER_ERROR);
        }
    }
}
