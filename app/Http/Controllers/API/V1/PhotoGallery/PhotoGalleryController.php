<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\PhotoGallery;

use App\Constants\HttpStatusCodesEnum;
use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\V1\PhotoGallery\PhotoGalleryNotFoundException;
use App\Constants\ErrorMessages;
use App\Http\Controllers\API\BaseApiController;
use App\Http\Resources\API\V1\PhotoGallery\PhotoGalleryResource;
use App\Services\PhotoGallery\PhotoGalleryService;
use Exception;
use Illuminate\Http\JsonResponse;

class PhotoGalleryController extends BaseApiController
{
    public function __construct(
        private readonly PhotoGalleryService $photoGalleryService
    ) {}

    /**
     * @OA\Get(
     *     path="/api/v1/photo-galleries",
     *     summary="Get photo galleries",
     *     description="Retrieve a list of photo galleries",
     *     operationId="getPhotoGalleries",
     *     tags={"Photo Gallery"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/PhotoGalleryResource")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Photo galleries not found"
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
            $photoGalleries = $this->photoGalleryService->getPhotoGalleries();

            return $this->successResponse(
                PhotoGalleryResource::collection($photoGalleries)->resolve(),
                null,
                HttpStatusCodesEnum::OK,
                null,
                SuccessCode::PHOTO_GALLERIES_RETRIEVED
            );
        } catch (PhotoGalleryNotFoundException $e) {
            return $this->errorResponse(
                $e->getMessage(),
                $e->getCode(),
                null,
                ErrorCode::PHOTO_GALLERY_NOT_FOUND,
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
