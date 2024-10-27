<?php

declare(strict_types=1);

namespace App\DTOs\Testimonial;

use App\Http\Requests\API\V1\Testimonial\CreateTestimonialRequest;

class TestimonialDTO
{
    public function __construct(
        public readonly ?int $id = null,
    ) {}

    // public static function fromRequest(CreateTestimonialRequest|UpdateTestimonialRequest $request): self
    // {
    //     $validated = $request->validated();
    //     return new self(
    //         id: $request instanceof UpdateTestimonialRequest ? $validated['id'] : null
    //     );
    // }

    /**
     * @param  array{id?: int}  $data
     */
    // public static function fromArray(array $data): self
    // {
    //     return new self(
    //         id: $data['id'] ?? null
    //     );
    // }

    /**
     * @return array{id?: int}
     */
    // public function toArray(): array
    // {
    //     $array = [];

    //     if ($this->id !== null) {
    //         $array['id'] = $this->id;
    //     }

    //     return $array;
    // }
}
