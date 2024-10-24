<?php

declare(strict_types=1);

namespace App\Exceptions\API\Auth;

use App\Enums\ErrorCode;
use App\Exceptions\BaseHttpException;

class RegisterException extends BaseHttpException
{
    public function __construct(?array $data = null)
    {
        parent::__construct(errorCode: ErrorCode::REGISTER_FAILED, httpStatus: 401, message: null, data: $data);
    }
}
