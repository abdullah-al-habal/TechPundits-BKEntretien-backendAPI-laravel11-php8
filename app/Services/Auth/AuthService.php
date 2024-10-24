<?php

namespace App\Services\Auth;

use App\Constants\AuthConstants;
use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterDTO;
use App\Exceptions\Api\V1\Auth\LoginException;
use App\Exceptions\Api\V1\Auth\LogoutException;
use App\Exceptions\Api\V1\Auth\RegisterException;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(LoginDTO $loginDTO): array
    {
        if (!Auth::attempt(['email' => $loginDTO->email, 'password' => $loginDTO->password])) {
            throw new LoginException(AuthConstants::INVALID_CREDENTIALS_MESSAGE);
        }

        /** @var User $user */
        $user = Auth::user();
        $token = $user->createToken(AuthConstants::AUTH_TOKEN_NAME)->plainTextToken;

        return [
            'user' => $user,
            'access_token' => $token,
            'token_type' => AuthConstants::TOKEN_TYPE,
        ];
    }

    public function logout(User $user): void
    {
        try {
            $user->tokens()->delete();
        } catch (\Exception $e) {
            throw new LogoutException(AuthConstants::LOGOUT_ERROR_MESSAGE);
        }
    }

    public function register(RegisterDTO $registerDTO): array
    {
        try {
            $user = User::create([
                'name' => $registerDTO->name,
                'email' => $registerDTO->email,
                'password' => Hash::make($registerDTO->password),
            ]);

            $token = $user->createToken(AuthConstants::AUTH_TOKEN_NAME)->plainTextToken;

            return [
                'user' => $user,
                'access_token' => $token,
                'token_type' => AuthConstants::TOKEN_TYPE,
            ];
        } catch (\Exception $e) {
            throw new RegisterException(AuthConstants::REGISTER_ERROR_MESSAGE);
        }
    }
}
