<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\ErrorCode;

class HealthCheckException extends BaseHttpException
{
    public function __construct(?array $data = null)
    {
        parent::__construct(
            errorCode: ErrorCode::HEALTH_CHECK_FAILED,
            httpStatus: 503,
            message: null,
            data: $data
        );
    }
}
