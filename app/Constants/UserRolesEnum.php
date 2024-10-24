<?php

declare(strict_types=1);

namespace App\Constants;

enum UserRolesEnum: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case GUEST = 'guest';
}
