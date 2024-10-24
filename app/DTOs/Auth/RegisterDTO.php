<?php

declare(strict_types=1);

namespace App\DTOs\Auth;

use App\Http\Requests\API\Auth\RegisterRequest;

class RegisterDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password
    ) {}

    public static function fromRequest(RegisterRequest $request): self
    {
        return new self(
            name: $request->input('name'),
            email: $request->input('email'),
            password: $request->input('password')
        );
    }
}
