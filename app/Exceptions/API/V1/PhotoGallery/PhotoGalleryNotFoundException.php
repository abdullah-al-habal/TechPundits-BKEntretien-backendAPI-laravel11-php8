<?php

declare(strict_types=1);

namespace App\Exceptions\API\V1\PhotoGallery;

use App\Enums\ErrorCode;
use App\Exceptions\BaseHttpException;

class PhotoGalleryNotFoundException extends BaseHttpException
{
    public function __construct(?array $data = null)
    {
        parent::__construct(errorCode: ErrorCode::SITE_SETTING_NOT_FOUND, httpStatus: 404, message: null, data: $data);
    }
}
