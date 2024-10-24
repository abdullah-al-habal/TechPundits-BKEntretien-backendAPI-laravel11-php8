<?php

declare(strict_types=1);

namespace App\Exceptions\API\V1\DrainCleaning;

use App\Enums\ErrorCode;
use App\Exceptions\BaseHttpException;

class DrainCleaningNotFoundException extends BaseHttpException
{
    public function __construct(?array $data = null)
    {
        parent::__construct(errorCode: ErrorCode::DRAIN_CLEANING_NOT_FOUND, httpStatus: 404, message: null, data: $data);
    }
}
