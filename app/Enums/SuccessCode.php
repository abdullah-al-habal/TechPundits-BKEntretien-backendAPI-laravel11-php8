<?php

declare(strict_types=1);

namespace App\Enums;

enum SuccessCode: string
{
    case SITE_SETTINGS_RETRIEVED = 'SITE_SETTINGS_RETRIEVED';
    case CONTACT_US_RETRIEVED = 'CONTACT_US_RETRIEVED';
    case TESTIMONIALS_RETRIEVED = 'TESTIMONIALS_RETRIEVED';
    case PHOTO_GALLERIES_RETRIEVED = 'PHOTO_GALLERIES_RETRIEVED';
    case DRAIN_CLEANING_RETRIEVED = 'DRAIN_CLEANING_RETRIEVED';
    case UNLOCKING_RETRIEVED = 'UNLOCKING_RETRIEVED';
    case HOME_PAGE_RETRIEVED = 'HOME_PAGE_RETRIEVED';
    case FAQS_RETRIEVED = 'FAQS_RETRIEVED';
    case LOGIN_SUCCESS = 'LOGIN_SUCCESS';
    case LOGOUT_SUCCESS = 'LOGOUT_SUCCESS';
    case REGISTER_SUCCESS = 'REGISTER_SUCCESS';
    case UNLOCKINGS_RETRIEVED = 'UNLOCKINGS_RETRIEVED';
    case HEALTH_CHECK_COMPLETED = 'HEALTH_CHECK_COMPLETED';
    case NOTIFICATION_SENT = 'NOTIFICATION_SENT';
    case DEVICE_TOKEN_UPDATED = 'DEVICE_TOKEN_UPDATED';
}
