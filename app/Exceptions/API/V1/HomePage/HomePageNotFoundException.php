<?php

declare(strict_types=1);

namespace App\Exceptions\API\V1\HomePage;

use App\Enums\ErrorCode;
use App\Exceptions\BaseHttpException;

class HomePageNotFoundException extends BaseHttpException
{
    public function __construct(?array $data = null)
    {
        parent::__construct(errorCode: ErrorCode::HOME_PAGE_NOT_FOUND, httpStatus: 404, message: null, data: $data);
    }
}
