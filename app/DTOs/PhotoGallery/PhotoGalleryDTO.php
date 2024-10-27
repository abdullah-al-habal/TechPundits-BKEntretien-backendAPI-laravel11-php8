<?php

declare(strict_types=1);

namespace App\DTOs\PhotoGallery;

use App\Http\Requests\API\V1\PhotoGallery\CreatePhotoGalleryRequest;

class PhotoGalleryDTO
{
    public function __construct(
        public readonly string $banner_image,
        public readonly string $banner_image_alt_text,
        public readonly string $title,
        public readonly string $description,
        public readonly string $main_image,
        public readonly string $main_image_alt_text,
        public readonly string $main_image_text,
        public readonly ?int $id = null,
    ) {}

    // public static function fromRequest(CreatePhotoGalleryRequest|UpdatePhotoGalleryRequest $request): self
    // {
    //     $validated = $request->validated();
    //     return new self(
    //         banner_image: $validated['banner_image'],
    //         banner_image_alt_text: $validated['banner_image_alt_text'],
    //         title: $validated['title'],
    //         description: $validated['description'],
    //         main_image: $validated['main_image'],
    //         main_image_alt_text: $validated['main_image_alt_text'],
    //         main_image_text: $validated['main_image_text'],
    //         id: $request instanceof UpdatePhotoGalleryRequest ? $validated['id'] : null
    //     );
    // }

    /**
     * @param  array{banner_image: string, banner_image_alt_text: string, title: string, description: string, main_image: string, main_image_alt_text: string, main_image_text: string, id?: int}  $data
     */
    // public static function fromArray(array $data): self
    // {
    //     return new self(
    //         banner_image: $data['banner_image'],
    //         banner_image_alt_text: $data['banner_image_alt_text'],
    //         title: $data['title'],
    //         description: $data['description'],
    //         main_image: $data['main_image'],
    //         main_image_alt_text: $data['main_image_alt_text'],
    //         main_image_text: $data['main_image_text'],
    //         id: $data['id'] ?? null
    //     );
    // }

    /**
     * @return array{banner_image: string, banner_image_alt_text: string, title: string, description: string, main_image: string, main_image_alt_text: string, main_image_text: string, id?: int}
     */
    // public function toArray(): array
    // {
    //     $array = [
    //         'banner_image' => $this->banner_image,
    //         'banner_image_alt_text' => $this->banner_image_alt_text,
    //         'title' => $this->title,
    //         'description' => $this->description,
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
