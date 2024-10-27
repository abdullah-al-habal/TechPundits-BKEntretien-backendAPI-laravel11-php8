<?php

declare(strict_types=1);

namespace App\Constants;

use App\Enums\ErrorCode;

class ErrorMessages
{
    public static array $messages = [
        ErrorCode::SITE_SETTING_NOT_FOUND->value => 'We couldn\'t find the site setting you\'re looking for. Please try again or contact support.',
        ErrorCode::INTERNAL_SERVER_ERROR->value => 'Oops! Something went wrong on our end. We\'re working to fix it. Please try again later.',
        ErrorCode::PHOTO_GALLERY_NOT_FOUND->value => 'We couldn\'t locate the photo gallery you requested. It may have been moved or deleted.',
        ErrorCode::UNLOCKING_NOT_FOUND->value => 'The unlocking service information you\'re looking for isn\'t available. Need help? Contact us!',
        ErrorCode::TESTIMONIAL_NOT_FOUND->value => 'We couldn\'t find the testimonial you\'re looking for. It might have been removed or relocated.',
        ErrorCode::HOME_PAGE_NOT_FOUND->value => 'We\'re having trouble loading the home page. Please refresh or try again later.',
        ErrorCode::FAQ_NOT_FOUND->value => 'The FAQ you\'re looking for seems to be missing. Try checking our main FAQ page for similar information.',
        ErrorCode::DRAIN_CLEANING_NOT_FOUND->value => 'We couldn\'t find the drain cleaning information you\'re looking for. Please check our services page or contact us directly.',
        ErrorCode::CONTACT_US_NOT_FOUND->value => 'Our contact information seems to be missing. Please try refreshing the page or visit our main website.',
        ErrorCode::LOGIN_FAILED->value => 'We couldn\'t log you in with those credentials. Please double-check and try again.',
        ErrorCode::LOGOUT_FAILED->value => 'We had trouble logging you out. Please try again, or for your security, consider closing your browser.',
        ErrorCode::REGISTER_FAILED->value => 'We encountered an issue while registering your account. Please try again or contact support if the problem persists.',
        ErrorCode::HEALTH_CHECK_FAILED->value => 'Our system health check encountered some issues. We\'re looking into it to ensure everything runs smoothly.',
        ErrorCode::CONTACT_US_FAILED->value => 'We couldn\'t process your contact request. Please try again or reach out to support.',
        ErrorCode::CREATE_CONTACT_US_FAILED->value => 'There was an error creating your contact request. Please try again or contact support.',
        ErrorCode::CREATE_FAQS_FAILED->value => 'We encountered an issue while creating the FAQ. Please try again or contact support.',
        ErrorCode::CREATE_TESTIMONIAL_FAILED->value => 'There was an error creating your testimonial. Please try again or contact support.',
        ErrorCode::CREATE_SITE_SETTING_FAILED->value => 'We couldn\'t create the site setting. Please try again or contact support.',
        ErrorCode::CREATE_PHOTO_GALLERY_FAILED->value => 'There was an error creating the photo gallery. Please try again or contact support.',
        ErrorCode::CREATE_HOME_PAGE_FAILED->value => 'We encountered an issue while creating the home page. Please try again or contact support.',
        ErrorCode::CREATE_FAQ_FAILED->value => 'There was an error creating the FAQ. Please try again or contact support.',
        ErrorCode::CREATE_UNLOCKING_FAILED->value => 'We couldn\'t create the unlocking service. Please try again or contact support.',
        ErrorCode::CREATE_DRAIN_CLEANING_FAILED->value => 'There was an error creating the drain cleaning service. Please try again or contact support.',
        ErrorCode::NOTIFICATION_SEND_FAILED->value => 'We couldn\'t send the notification. Please check the recipient details and try again.',
    ];

    public static function getMessage(ErrorCode $code): string
    {
        return self::$messages[$code->value] ?? 'Oops! Something unexpected happened. We\'re on it! Please try again later or contact support if the issue persists.';
    }
}
