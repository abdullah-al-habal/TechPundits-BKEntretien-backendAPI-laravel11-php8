<?php

declare(strict_types=1);

namespace App\Constants;

enum ApiResponseTypeEnum: string
{
    case SUCCESS = 'success';
    case ERROR = 'error';
}
