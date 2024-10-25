<?php

declare(strict_types=1);

namespace App\DTOs\DrainCleaning;

use App\Http\Requests\API\V1\DrainCleaning\CreateDrainCleaningRequest;

class DrainCleaningDTO
{
    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly ?int $id = null,
    ) {}

    // public static function fromRequest(CreateDrainCleaningRequest|UpdateDrainCleaningRequest $request): self
    // {
    //     $validated = $request->validated();
    //     return new self(
    //         title: $validated['title'],
    //         description: $validated['description'],
    //         id: $request instanceof UpdateDrainCleaningRequest ? $validated['id'] : null
    //     );
    // }

    /**
     * @param array{title: string, description: string, id?: int} $data
     */
    // public static function fromArray(array $data): self
    // {
    //     return new self(
    //         title: $data['title'],
    //         description: $data['description'],
    //         id: $data['id'] ?? null
    //     );
    // }

    /**
     * @return array{title: string, description: string, id?: int}
     */
    // public function toArray(): array
    // {
    //     $array = [
    //         'title' => $this->title,
    //         'description' => $this->description,
    //     ];

    //     if ($this->id !== null) {
    //         $array['id'] = $this->id;
    //     }

    //     return $array;
    // }
}
