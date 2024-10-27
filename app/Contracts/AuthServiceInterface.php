<?php

declare(strict_types=1);

namespace App\Contracts;

use App\DTOs\Auth\LoginDTO;
use App\DTOs\Auth\RegisterDTO;
use App\Models\User;

interface AuthServiceInterface
{
    public function login(LoginDTO $loginDTO): array;

    public function logout(User $user): void;

    public function register(RegisterDTO $registerDTO): array;
}
