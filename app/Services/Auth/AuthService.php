<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Constants\AuthConstants;
use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterDTO;
use App\Exceptions\API\Auth\LoginException;
use App\Exceptions\API\Auth\LogoutException;
use App\Exceptions\API\Auth\RegisterException;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(LoginDTO $loginDTO): array
    {
        if (!Auth::attempt(credentials: ['email' => $loginDTO->email, 'password' => $loginDTO->password])) {
            throw new LoginException();
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
        } catch (Exception $e) {
            throw new LogoutException();
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
        } catch (Exception $e) {
            throw new RegisterException();
        }
    }
}
