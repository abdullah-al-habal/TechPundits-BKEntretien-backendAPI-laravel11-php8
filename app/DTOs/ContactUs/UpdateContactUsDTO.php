<?php

declare(strict_types=1);

namespace App\DTOs\ContactUs;

use App\Http\Requests\API\V1\ContactUs\UpdateContactUsRequest;

class UpdateContactUsDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $email,
        public readonly string $message
    ) {}

    public static function fromRequest(UpdateContactUsRequest $request): self
    {
        $validated = $request->validated();
        return new self(
            id: $validated['id'],
            name: $validated['name'],
            email: $validated['email'],
            message: $validated['message']
        );
    }

    /**
     * @param array{id: int, name: string, email: string, message: string} $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            email: $data['email'],
            message: $data['message']
        );
    }

    /**
     * @return array{id: int, name: string, email: string, message: string}
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ];
    }
}
