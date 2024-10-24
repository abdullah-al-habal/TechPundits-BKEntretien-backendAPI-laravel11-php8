<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\SuccessCode;

class SuccessMessages
{
    public static array $messages = [
        SuccessCode::SITE_SETTINGS_RETRIEVED->value => 'Site settings have been successfully retrieved!',
        SuccessCode::FAQS_RETRIEVED->value => 'FAQs have been successfully retrieved!',
        SuccessCode::PHOTO_GALLERIES_RETRIEVED->value => 'Photo galleries have been successfully retrieved!',
        SuccessCode::REGISTER_SUCCESS->value => 'You have successfully registered!',
        SuccessCode::LOGIN_SUCCESS->value => 'You have successfully logged in!',
        SuccessCode::LOGOUT_SUCCESS->value => 'You have successfully logged out!',
        SuccessCode::HOME_PAGE_RETRIEVED->value => 'Home page has been successfully retrieved!',
        SuccessCode::DRAIN_CLEANING_RETRIEVED->value => 'Drain cleaning information has been successfully retrieved!',
        SuccessCode::CONTACT_US_RETRIEVED->value => 'Contact us information has been successfully retrieved!',
        SuccessCode::TESTIMONIALS_RETRIEVED->value => 'Testimonials have been successfully retrieved!',
        SuccessCode::UNLOCKINGS_RETRIEVED->value => 'Unlockings have been successfully retrieved!',
    ];

    public static function getMessage(SuccessCode $code): string
    {
        return self::$messages[$code->value] ?? 'The operation has been completed successfully!';
    }
}
