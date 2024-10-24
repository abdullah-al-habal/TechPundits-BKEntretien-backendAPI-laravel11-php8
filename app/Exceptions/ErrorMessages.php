<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\ErrorCode;

class ErrorMessages
{
    public static array $messages = [
        ErrorCode::SITE_SETTING_NOT_FOUND->value => 'No site settings found',
        ErrorCode::INTERNAL_SERVER_ERROR->value => 'An error occurred while fetching site settings',
    ];

    public static function getMessage(ErrorCode $code): string
    {
        return self::$messages[$code->value] ?? 'An unknown error occurred';
    }
}
