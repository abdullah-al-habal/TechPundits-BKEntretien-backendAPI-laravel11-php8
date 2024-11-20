<?php

declare(strict_types=1);

namespace App\Http\Resources\API\V1\Testimonial;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestimonialResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'banner_image' => $this->getFullUrl($this->banner_image),
            'banner_image_alt_text' => $this->banner_image_alt_text,
            'banner_image_text' => $this->banner_image_text,
            'main_image' => $this->getFullUrl($this->main_image),
            'main_image_alt_text' => $this->main_image_alt_text,
            'main_image_text' => $this->main_image_text,
            'sections' => $this->when($this->relationLoaded('sections'), fn() => TestimonialSectionResource::collection($this->sections)),
        ];
    }

    public function with(Request $request): array
    {
        return [
            'meta' => [
                'version' => config('app.version', '1.0'),
                'api_version' => 'v1',
            ],
        ];
    }
}
