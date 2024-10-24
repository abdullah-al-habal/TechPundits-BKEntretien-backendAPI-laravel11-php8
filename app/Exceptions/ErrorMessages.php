<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\ErrorCode;

class ErrorMessages
{
    public static array $messages = [
        ErrorCode::SITE_SETTING_NOT_FOUND->value => 'Site setting not found',
        ErrorCode::INTERNAL_SERVER_ERROR->value => 'Oops! Something went wrong on our end. We\'re working to fix it.',
        ErrorCode::PHOTO_GALLERY_NOT_FOUND->value => 'Photo gallery not found',
        ErrorCode::UNLOCKING_NOT_FOUND->value => 'Unlocking not found',
        ErrorCode::TESTIMONIAL_NOT_FOUND->value => 'Testimonial not found',
        ErrorCode::HOME_PAGE_NOT_FOUND->value => 'Home page not found',
        ErrorCode::FAQ_NOT_FOUND->value => 'FAQ not found',
        ErrorCode::DRAIN_CLEANING_NOT_FOUND->value => 'Drain cleaning not found',
        ErrorCode::CONTACT_US_NOT_FOUND->value => 'Contact us not found',
        ErrorCode::LOGIN_FAILED->value => 'Invalid credentials. Please try again.',
        ErrorCode::LOGOUT_FAILED->value => 'Logout failed',
        ErrorCode::REGISTER_FAILED->value => 'Registration failed',
    ];

    public static function getMessage(ErrorCode $code): string
    {
        return self::$messages[$code->value] ?? 'Oops! Something went wrong. Please try again later.';
    }
}
