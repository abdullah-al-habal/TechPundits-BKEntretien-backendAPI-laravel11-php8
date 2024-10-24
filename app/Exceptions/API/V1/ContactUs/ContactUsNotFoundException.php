<?php

declare(strict_types=1);

namespace App\Exceptions\API\V1\ContactUs;

use App\Enums\ErrorCode;
use App\Exceptions\BaseHttpException;

class ContactUsNotFoundException extends BaseHttpException
{
    public function __construct(?array $data = null)
    {
        parent::__construct(errorCode: ErrorCode::CONTACT_US_NOT_FOUND, httpStatus: 404, message: null, data: $data);
    }
}
