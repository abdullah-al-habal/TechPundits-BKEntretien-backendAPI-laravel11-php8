<?php

declare(strict_types=1);

namespace App\Http\Resources\API\V1\PhotoGallery;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PhotoGallerySectionImageResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'image' => $this->image,
            'alt_text' => $this->alt_text,
            'description' => $this->description,
        ];
    }
}
