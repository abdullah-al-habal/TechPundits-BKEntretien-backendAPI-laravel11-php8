<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\SuccessCode;

class SuccessMessages
{
    public static array $messages = [
        SuccessCode::SITE_SETTINGS_RETRIEVED->value => 'Site settings retrieved successfully'
    ];

    public static function getMessage(SuccessCode $code): string
    {
        return self::$messages[$code->value] ?? 'Operation completed successfully';
    }
}