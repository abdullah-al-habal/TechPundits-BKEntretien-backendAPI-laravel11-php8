<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\SuccessCode;

class SuccessMessages
{
    public static array $messages = [
        SuccessCode::SITE_SETTINGS_RETRIEVED->value => 'Great! We\'ve successfully loaded the site settings for you.',
        SuccessCode::CONTACT_US_RETRIEVED->value => 'Contact information is ready for you. Need to reach out?',
        SuccessCode::TESTIMONIALS_RETRIEVED->value => 'Check out what others are saying! Testimonials are now available.',
        SuccessCode::PHOTO_GALLERIES_RETRIEVED->value => 'Picture perfect! The photo galleries are ready for your viewing.',
        SuccessCode::DRAIN_CLEANING_RETRIEVED->value => 'All the drain cleaning info you need is now at your fingertips.',
        SuccessCode::UNLOCKING_RETRIEVED->value => 'Unlocking services information is now available. Need help?',
        SuccessCode::HOME_PAGE_RETRIEVED->value => 'Welcome! The home page is all set for you to explore.',
        SuccessCode::FAQS_RETRIEVED->value => 'Got questions? We\'ve got answers! FAQs are now loaded.',
        SuccessCode::LOGIN_SUCCESS->value => 'Welcome back! You\'re now logged in and ready to go.',
        SuccessCode::LOGOUT_SUCCESS->value => 'You\'ve been safely logged out. Have a great day!',
        SuccessCode::REGISTER_SUCCESS->value => 'Awesome! Your account has been created successfully. Welcome aboard!',
        SuccessCode::UNLOCKINGS_RETRIEVED->value => 'Unlocking service details are ready. Locked out? We\'ve got you covered!',
        SuccessCode::HEALTH_CHECK_COMPLETED->value => 'Good news! Our system health check is complete and everything looks great.',
    ];

    public static function getMessage(SuccessCode $code): string
    {
        return self::$messages[$code->value] ?? 'Success! The operation you requested is complete.';
    }
}
