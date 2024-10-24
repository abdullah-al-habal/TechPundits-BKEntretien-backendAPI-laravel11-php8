<?php

declare(strict_types=1);

namespace App\Exceptions\API\Auth;

use App\Enums\ErrorCode;
use App\Exceptions\BaseHttpException;

class LoginException extends BaseHttpException
{
    public function __construct(?array $data = null)
    {
        parent::__construct(errorCode: ErrorCode::LOGIN_FAILED, httpStatus: 401, message: null, data: $data);
    }
}
