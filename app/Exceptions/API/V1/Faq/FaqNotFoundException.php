<?php

declare(strict_types=1);

namespace App\Exceptions\API\V1\Faq;

use App\Enums\ErrorCode;
use App\Exceptions\BaseHttpException;

class FaqNotFoundException extends BaseHttpException
{
    public function __construct(?array $data = null)
    {
        parent::__construct(errorCode: ErrorCode::FAQ_NOT_FOUND, httpStatus: 404, message: null, data: $data);
    }
}
