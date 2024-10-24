<?php

namespace App\Enums;

enum ErrorCode: string
{
    case SITE_SETTING_NOT_FOUND = 'SITE_SETTING_NOT_FOUND';
    case INTERNAL_SERVER_ERROR = 'INTERNAL_SERVER_ERROR';
}
