<?php

declare(strict_types=1);

namespace App\DTOs\Unlocking;

use App\Http\Requests\API\V1\Unlocking\CreateUnlockingRequest;

class UnlockingDTO
{
    public function __construct(
        public readonly string $banner_image,
        public readonly string $banner_image_alt_text,
        public readonly string $banner_image_text,
        public readonly string $main_image,
        public readonly string $main_image_alt_text,
        public readonly string $main_image_text,
        public readonly ?int $id = null,
    ) {}

    // public static function fromRequest(CreateUnlockingRequest|UpdateUnlockingRequest $request): self
    // {
    //     $validated = $request->validated();
    //     return new self(
    //         banner_image: $validated['banner_image'],
    //         banner_image_alt_text: $validated['banner_image_alt_text'],
    //         banner_image_text: $validated['banner_image_text'],
    //         main_image: $validated['main_image'],
    //         main_image_alt_text: $validated['main_image_alt_text'],
    //         main_image_text: $validated['main_image_text'],
    //         id: $request instanceof UpdateUnlockingRequest ? $validated['id'] : null
    //     );
    // }

    /**
     * @param array{banner_image: string, banner_image_alt_text: string, banner_image_text: string, main_image: string, main_image_alt_text: string, main_image_text: string, id?: int} $data
     */
    // public static function fromArray(array $data): self
    // {
    //     return new self(
    //         banner_image: $data['banner_image'],
    //         banner_image_alt_text: $data['banner_image_alt_text'],
    //         banner_image_text: $data['banner_image_text'],
    //         main_image: $data['main_image'],
    //         main_image_alt_text: $data['main_image_alt_text'],
    //         main_image_text: $data['main_image_text'],
    //         id: $data['id'] ?? null
    //     );
    // }

    /**
     * @return array{banner_image: string, banner_image_alt_text: string, banner_image_text: string, main_image: string, main_image_alt_text: string, main_image_text: string, id?: int}
     */
    // public function toArray(): array
    // {
    //     $array = [
    //         'banner_image' => $this->banner_image,
    //         'banner_image_alt_text' => $this->banner_image_alt_text,
    //         'banner_image_text' => $this->banner_image_text,
    //         'main_image' => $this->main_image,
    //         'main_image_alt_text' => $this->main_image_alt_text,
    //         'main_image_text' => $this->main_image_text,
    //     ];

    //     if ($this->id !== null) {
    //         $array['id'] = $this->id;
    //     }

    //     return $array;
    // }
}
