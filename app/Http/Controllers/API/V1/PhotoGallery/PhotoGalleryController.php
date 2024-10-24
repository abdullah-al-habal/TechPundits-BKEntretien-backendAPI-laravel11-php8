<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\PhotoGallery;

use App\Enums\ErrorCode;
use App\Enums\SuccessCode;
use App\Exceptions\API\V1\PhotoGallery\PhotoGalleryNotFoundException;
use App\Exceptions\ErrorMessages;
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

    public function index(): JsonResponse
    {
        try {
            $photoGalleries = $this->photoGalleryService->getPhotoGalleries();

            return $this->sendResponse(
                PhotoGalleryResource::collection($photoGalleries),
                SuccessCode::PHOTO_GALLERIES_RETRIEVED,
                200
            );
        } catch (PhotoGalleryNotFoundException $e) {
            return $this->sendError($e->getMessage(), $e->getCode(), ErrorCode::PHOTO_GALLERY_NOT_FOUND);
        } catch (Exception $e) {
            return $this->sendError(ErrorMessages::getMessage(ErrorCode::INTERNAL_SERVER_ERROR), 500, ErrorCode::INTERNAL_SERVER_ERROR);
        }
    }
}
