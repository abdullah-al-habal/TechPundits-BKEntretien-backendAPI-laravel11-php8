<?php

declare(strict_types=1);

namespace App\Constants;

class AuthConstants
{
    public const TOKEN_TYPE = 'Bearer';
    public const AUTH_TOKEN_NAME = 'auth_token';
    public const LOGIN_SUCCESS_MESSAGE = 'User logged in successfully';
    public const LOGIN_ERROR_MESSAGE = 'An error occurred during login';
    public const INVALID_CREDENTIALS_MESSAGE = 'Invalid credentials';
    public const LOGOUT_SUCCESS_MESSAGE = 'Logged out successfully';
    public const LOGOUT_ERROR_MESSAGE = 'An error occurred during logout';
    public const REGISTER_SUCCESS_MESSAGE = 'User registered successfully';
    public const REGISTER_ERROR_MESSAGE = 'An error occurred during registration';
}
