<?php

declare(strict_types=1);

namespace App\Http\Resources\API\V1\PhotoGallery;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PhotoGallerySectionResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'images' => $this->when($this->relationLoaded('images'), fn() => PhotoGallerySectionImageResource::collection($this->images)),
        ];
    }

    /**
     * Generate the full URL for the given image.
     *
     * @param string|null $image
     * @return string|null
     */
    private function getFullUrl(?string $image): ?string
    {
        if (!$image) {
            return null;
        }

        $appUrl = config('app.url', env('APP_URL', 'http://localhost'));

        return filter_var($image, FILTER_VALIDATE_URL) !== false
            ? $image
            : $appUrl . '/storage/' . ltrim($image, '/');
    }
}
