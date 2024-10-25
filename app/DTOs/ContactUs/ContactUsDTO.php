<?php

declare(strict_types=1);

namespace App\DTOs\ContactUs;

use App\Http\Requests\API\V1\ContactUs\CreateContactUsRequest;
use App\Http\Requests\API\V1\ContactUs\UpdateContactUsRequest;

class ContactUsDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $message,
        public readonly ?int $id = null,
    ) {}

    public static function fromRequest(CreateContactUsRequest|UpdateContactUsRequest $request): self
    {
        $validated = $request->validated();
        return new self(
            name: $validated['name'],
            email: $validated['email'],
            message: $validated['message'],
            id: $request instanceof UpdateContactUsRequest ? $validated['id'] : null
        );
    }

    /**
     * @param array{name: string, email: string, message: string, id?: int} $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            message: $data['message'],
            id: $data['id'] ?? null
        );
    }

    /**
     * @return array{name: string, email: string, message: string, id?: int}
     */
    public function toArray(): array
    {
        $array = [
            'name' => $this->name,
            'email' => $this->email,
            'message' => $this->message,
        ];

        if ($this->id !== null) {
            $array['id'] = $this->id;
        }

        return $array;
    }
}
