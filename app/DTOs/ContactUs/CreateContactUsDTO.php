<?php

declare(strict_types=1);

namespace App\DTOs\ContactUs;

use App\Http\Requests\API\V1\ContactUs\CreateContactUsRequest;

class CreateContactUsDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $message
    ) {}

    public static function fromRequest(CreateContactUsRequest $request): self
    {
        $validated = $request->validated();

        return new self(
            name: $validated['name'],
            email: $validated['email'],
            message: $validated['message']
        );
    }

    /**
     * @param  array{name: string, email: string, message: string}  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            message: $data['message']
        );
    }

    /**
     * @return array{name: string, email: string, message: string}
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ];
    }
}
