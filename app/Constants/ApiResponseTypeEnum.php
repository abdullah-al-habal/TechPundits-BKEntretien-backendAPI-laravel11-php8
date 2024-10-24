<?php

declare(strict_types=1);

namespace App\Constants;

enum ApiResponseTypeEnum: string
{
    case SUCCESS = 'success';
    case ERROR = 'error';

    public function translatedText(): string
    {
        return trans("api_response_type.$this->value");
    }
}
